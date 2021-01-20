@extends('layouts.app')

@section('content')

    {{--    Search Form--}}
    <div class="container">
        <div id="error" class="alert alert-danger alert-dismissible fade show" role="alert" style="display: none;">
            <p style="text-align: center"><strong></strong></p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="date_check">
            <p></p>
        </div>
        <div class="row m-3">
            <form class="form-inline">
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">Staff Number</div>
                    </div>
                    <input type="text" class="form-control" id="staff_id" placeholder="eg. 000000" required>
                </div>
                @csrf
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">From</div>
                    </div>
                    <input type="text" class="form-control" name="from" id="from" placeholder="From" required>
                </div>

                @push('scripts')
                    <script type="text/javascript">
                        $('#from').datetimepicker({
                            format: 'YYYY-MM-DD',
                            useCurrent: true,
                            icons: {
                                up: "icon-arrow-up-circle icons font-2xl",
                                down: "icon-arrow-down-circle icons font-2xl"
                            },
                            sideBySide: true
                        })
                    </script>
                @endpush

                <label class="sr-only" for="inlineFormInputGroupUsername2">To</label>
                <div class="input-group mb-2 mr-sm-2">
                    <div class="input-group-prepend">
                        <div class="input-group-text">To</div>
                    </div>
                    <input type="text" class="form-control" name="to" id="to" placeholder="To" required>
                </div>

                @push('scripts')
                    <script type="text/javascript">
                        $('#to').datetimepicker({
                            format: 'YYYY-MM-DD',
                            useCurrent: true,
                            icons: {
                                up: "icon-arrow-up-circle icons font-2xl",
                                down: "icon-arrow-down-circle icons font-2xl"
                            },
                            sideBySide: true
                        })
                    </script>
                @endpush


                <button type="submit" class="btn btn-primary mb-2">Generate Statement</button>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="row m-3">
            <table class="table table-bordered ">
                <thead>
                <tr>
                    <th class="center-text" colspan="4">MEMBER STATEMENT</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="bold-font">Staff Name</td>
                    <td id="staff_name"></td>
                    <td class="bold-font">Staff ID</td>
                    <td id="staff_no"></td>
                </tr>
                <tr>
                    <td class="bold-font">Member ID</td>
                    <td id="member_id"></td>
                    <td class="bold-font">Contact</td>
                    <td id="contact">-</td>
                </tr>
                <tr>
                    <td class="bold-font">Division</td>
                    <td id="division"></td>
                    <td class="bold-font">From</td>
                    <td id="from_date"></td>
                </tr>
                <tr>
                    <td class="bold-font">Department</td>
                    <td id="department"></td>
                    <td class="bold-font">To</td>
                    <td id="to_date"></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="row m-md-3">
            <table class="table table-bordered ">
                <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Reference</th>
                    <th>Amount</th>
                    <th>Balance</th>
                </tr>
                </thead>
                <tbody id="tbody">

                </tbody>
            </table>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                }
            });

            $("#staff_id").keyup(() => {
                $("#error").css("display", "none");
            })

            $(".date_check").hide();

            // $("#from").datetimepicker({
            //     onChangeDateTime:function(dp,$input){
            //         alert('It is working')
            //     }
            // })

            $('form').submit(function (event) {
                event.preventDefault();
                const fromDate = $('input[name=from]').val()
                const toDate = $('input[name=to]').val();
                if (Date.parse(fromDate) > Date.parse(toDate)) {
                    $("#error").fadeToggle('slow','linear', ()=>{
                        $("#error p").text("The EndDate cannot be less than the StartDate");
                    });

                    // $(".date_check").fadeToggle('slow','linear', ()=> {
                    //         $(".date_check p").text("The EndDate cannot be less than the StartDate");
                    // })

                } else {
                    const formData = {
                        'staff_id': $('#staff_id').val(),
                        'from': fromDate,
                        'to': toDate
                    }

                    $("#tbody").html("");
                    let markup = "";
                    $.ajax({
                        type: "POST",
                        url: '/admin/reports/generate_statement',
                        data: formData,
                        success: (response) => {
                            if (response.hasOwnProperty("error")) {
                                console.log(response.error);
                                $("#error p").text(response.error);
                                $("#error").css("display", "block");
                                $("#staff_name").html("");
                                $("#staff_no").html("");
                                $("#member_id").html("");
                                $("#department").html("");
                                $("#division").html("");
                                $("#from_date").html("");
                                $("#to_date").html("");
                                $("#contact").html("");
                            } else {
                                const {member_details, department, division, user, to, from, transactions} = response.message
                                $("#staff_name").text(user.name);
                                $("#staff_no").text(user.name);
                                $("#member_id").text(member_details.member_id);
                                $("#department").text(department.name);
                                $("#division").text(division.name);
                                $("#from_date").text(from);
                                $("#to_date").text(to);
                                $("#contact").text(user.email);

                                transactions.forEach(transaction => {
                                    markup = "<tr>" +
                                        "<td>" + transaction.transaction_date + "</td>" +
                                        "<td>" + transaction.transaction_type + "</td>" +
                                        "<td>" + transaction.transaction_type + "</td>" +
                                        "<td>" + transaction.amount + "</td>" +
                                        "<td>" + transaction.balance + "</td>" +
                                        "</tr>"
                                    $("#tbody").append(markup);
                                })
                                console.log(response.message);
                            }


                        },
                        error: (response) => {
                            console.log(response.error);
                        }
                    });
                }

            })


        })

    </script>

@endpush
