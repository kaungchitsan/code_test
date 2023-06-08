@extends('backend.layouts.app')
@section('title', 'Billing')

@section('current', 'Billing')
@section('previous_link')
<a class="opacity-5 text-dark" href="{{url("/admin/dashboard")}}">Dashboard</a>
@stop

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0 d-flex justify-content-between ">
                <h6>Client table</h6>
                <a href="{{ route('billings.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i></a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="billings-table">
                            <thead>
                                <tr>
                                <th class="text-center text-uppercase fw-bolder">Client Name</th>
                                <th class="text-center text-uppercase fw-bolder">Amount</th>
                                <th class="text-center text-uppercase fw-bolder">Due Date</th>
                                <th class="text-center text-uppercase fw-bolder">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){
        let table = $('#billings-table').DataTable({
        serverSide: true,
        ajax: "/admin/billings/datatables/ssd",
        columns : [
            {  data : 'client_name' , name : 'client_name', class : 'text-center ' },
            {  data : 'amount' , name : 'amount', class : 'text-center ' },
            {  data : 'due_date' , name : 'due_date', class : ' text-center' },
            {  data : 'action' , name : 'action', class : 'text-center' }
        ],
        });

        $(document).on('change','.toggle-event',function(e) {
                e.preventDefault();
                 let id = $(this).data('id');
                 let active = $(this).data('active');
                $.ajax({
                    url: '/admin/billings/toggle/'+ id,
                    type: "POST",
                    data : {
                        'value' : active
                    },
                    success: function(res){
                        if(res.status == 'success'){
                            const Toast = Swal.mixin({
                                        toast: true,
                                        position: 'top-end',
                                        showConfirmButton: false,
                                        timer: 3000,
                                        timerProgressBar: true,
                                        didOpen: (toast) => {
                                            toast.addEventListener('mouseenter', Swal.stopTimer)
                                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                                        }
                                        })
                                        
                                        Toast.fire({
                                        icon: 'success',
                                        title: 'Updated'
                            })
                        }else{
                            alert('error')
                        }
                    }
                })
        })
    
        $(document).on('click','#delete',function(e){
            e.preventDefault();

            let id = $(this).data('id');
            
            const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-success',
                                cancelButton: 'btn btn-danger'
                            },
                            buttonsStyling: false
                            })
                            swalWithBootstrapButtons.fire({
                            title: 'Are you sure?',
                            text: "You want to delete!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Confirm',
                            cancelButtonText: 'Cancel',
                            reverseButtons: true
                            }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url : "/admin/billings/"+id,
                                    type : "DELETE",
                                    success : function(){
                                        table.ajax.reload();
                                    }
                                });
                            }
                            })
                    
            })
    });
</script>
@endsection