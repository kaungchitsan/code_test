@extends('backend.layouts.app')
@section('title', 'Client')

@section('current', 'Client')
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
                <a href="{{ route('clients.create') }}" class="btn btn-sm btn-success"><i class="fas fa-plus"></i></a>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" id="clients-table">
                            <thead>
                                <tr>
                                <th class="text-center text-uppercase fw-bolder">Client Name</th>
                                <th class="text-center text-uppercase fw-bolder">Email</th>
                                <th class="text-center text-uppercase fw-bolder">Phone</th>
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
        let table = $('#clients-table').DataTable({
        serverSide: true,
        ajax: "/admin/clients/datatables/ssd",
        columns : [
            {  data : 'name' , name : 'name', class : 'text-center ' },
            {  data : 'email' , name : 'email', class : 'text-center ' },
            {  data : 'phone' , name : 'phone', class : ' text-center' },
            {  data : 'action' , name : 'action', class : 'text-center' }
        ],
        });

        $(document).on('change','.toggle-event',function(e) {
                e.preventDefault();
                 let id = $(this).data('id');
                 let active = $(this).data('active');
                $.ajax({
                    url: '/admin/clients/toggle/'+ id,
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
                                    url : "/admin/clients/"+id,
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