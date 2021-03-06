<?php use App\Http\Controllers\HelpersController as Helpers; 

$haveaccessadd = Helpers::checkaccess('users', 'add');
$haveaccessdelete = Helpers::checkaccess('users', 'delete');

?><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight hetf2"><i class="bi bi-person-plus-fill"></i>
            {{ __('Customers') }} <button class="btn btn-success btn-sm" id="btn_addcustomer" onclick="addModal()"><i class="fa fa-plus"></i> Add Customers</button> 
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                   <div class="table-responsive">
                        <table id="userstable" class="table text-start table-striped align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="name" name="name"></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="email" name="email"></td>
                                    <td><input type="text" class="form-control input-sm src_class_user" autocomplete="off" onkeyup="searcAjax(this)" placeholder="no_tlp" name="no_tlp"></td>
                                   
                                    <td>
                                        <select name="searchactive" class="form-control input-sm src_class_user" onchange="searcAjax(this, 1)">
                                          <option value="">-- Status Active --</option>
                                          <option value="1">Active</option>
                                          <option value="0">Not Active</option>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <th><input type="checkbox" class="checkall" name="checkall"></th>
                                    <th class="align-center">Name</th>
                                    <th class="align-center">Email</th>
                                    <th class="align-center">Nomor Telepon</th>
                                    <th class="align-center">Active</th>
                                    <th class="align-center">Flag_delete</th>
                                    <th class="align-center">Action</th>
                                    
                                </tr>
                                
                            </thead>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th class="align-center">Name</th>
                                    <th class="align-center">Email</th>
                                    <th class="align-center">Nomor Telepon</th>
                                    <th class="align-center">Active</th>
                                    <th class="align-center">flag_delete</th>
                                    <th class="align-center">Action</th>
                                    
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<!-- Add modal -->
<div class="modal fade" id="addmodall" tabindex="-1" role="dialog" aria-labelledby="viewUserTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header">
        <div class="modal-header d-flex justify-content-start ">
            <h2 id="icon"></h2><h5 id="titleaddmodal" class="ms-2 modal-title"></h5>
        </div>
    </div>

    <div class="modal-body">
      <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Main Info</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">User Access</button>
                </li>
            </ul>
            <div class="modal-body">
                <div class="mb-3">
                    <div class="col">
                        <form id="formm">
                            @csrf
                            <input type="hidden" name="id" id="id">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" placeholder="Nama" name="name" id="name" aria-describedby="validationServer03Feedback">
                    </div> 
                </div>

                <div class="mb-3">
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" placeholder="Email" name="email" id="email" aria-describedby="validationServer03Feedback">
                    </div> 
                </div>

                <div class="mb-3">
                    <div class="col">
                        <label for="no_tlp" class="form-label">No Telepon</label>
                        <input type="text" class="form-control" placeholder="No Telepon" name="no_tlp" id="no_tlp" aria-describedby="validationServer03Feedback">
                    </div> 
                </div>

                <div class="mb-3">
                    <div class="col">
                        <label for="active" class="form-label">Status Active</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="1" name="active" id="active" checked>
                            <label class="form-check-label" for="active">
                                Active
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" value="0" name="active" id="active2">
                            <label class="form-check-label" for="active2">
                                Not Active
                            </label>
                        </div>
                    </div>
                </div>

                <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <dl class="row mb-0" id="datauser-1"></dl>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <dl class="row mb-0" id="datauser-2"></dl>
            </div>

        </div>
    </div>

    <div class="modal-footer">
      <button id="closeModalViewUser" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
      <button id="save" type="button" class="btn btn-success btn-sm" data-dismiss="modal">Save</button>

    </form>
    </div>
    </div>
  </div>
</div>
</div>



{{-- View Modal --}}
<div class="modal fade" id="viewCustomer" tabindex="-1" role="dialog" aria-labelledby="viewUserTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-lg-start">
                <h4><i class="bi bi-clipboard2-minus"></i></i></h4>
                <h5 id="titledetailmodal" class="ms-2 modal-title"></h5>
            </div>
            <div class="modal-body">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade active show" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                        <dl class="row mb-0">
                            <dt class="col-sm-4">Nama </dt>
                                <dd class="col-sm-8">: <span name="name" id="show_name"></dd>
                            <dt class="col-sm-4">Email </dt>
                                <dd class="col-sm-8">: <span name="email" id="show_email"></dd>
                            <dt class="col-sm-4">Nomor Telepon</dt>
                                <dd class="col-sm-8">: <span name="no_tlp" id="show_no_tlp"></dd>
                            <dt class="col-sm-4">Status</dt>
                                <dd class="col-sm-8">: <span id="activedetail"></span>
                            <dt class="col-sm-4">Status Delete</dt>
                                <dd class="col-sm-4">: <span id="flagdelete"></span></dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="closeModalViewUser" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                @if ($haveaccessadd) 
                <button class="btn btn-success btn-sm" data-attid="" onclick="editshow()" id="editbtn"><i class="fa fa-edit"></i> Edit Customers</button>
              @endif
                @if ($haveaccessdelete)
                    <button onClick="deleteyesshow()" data-attid="" data-deleteval="1" id="deletevbtn" class="btn btn-danger btn-sm"></a>
                        <button onClick="undeleteyesshow()" data-attid="" data-deleteval="0" id="undeletevbtn" class="btn btn-warning btn-sm"></button>
                @endif
            </div>
        </div>
    </div>
</div>

@section('script')
<script type="text/javascript">
    var url = "{{ asset('/api/customers/getdata') }}";
    function searcAjax(a, skip = 0){
        if($(a).val().length > global_length_src || skip == 1) {
            var getparam = getAllClassAndVal("src_class_user"); // helpers
            $('#userstable').DataTable().ajax.url(url+"?"+getparam).load();
        }
        else {
          $('#userstable').DataTable().ajax.url(url).load();
        }
    }

    $(document).ready(function(){
        var getndate = getNowdate(); // helpers
        $("#daterangepicker").val(getndate + ' - ' + getndate );
        $(".datepicker").val(getndate);
        $('.datepicker').daterangepicker({
            singleDatePicker: true,
            timePicker: false,
            locale: {
              format: "DD/MM/YYYY"
            }
        });

        $("#daterangepicker").daterangepicker({
            timePicker: false,
            locale: {
              format: "DD/MM/YYYY"
            }
        });


        var table = $('#userstable').DataTable({
            ajax: url,
            columnDefs: [
                 {
                   'targets': 6,
                   'searchable':false,
                   'orderable':false,
                   'className': 'dt-body-center',
                   'render': function (data, type, full, meta){
                       return '<span class="btn btn-info btn-sm" onclick="showdetail('+full[6]+')">details</span>';
                   }
                }, {
                   'targets': 0,
                   'searchable':false,
                   'orderable':false,
                   'className': 'dt-body-center',
                   'render': function (data, type, full, meta){
                       return '<input type="checkbox" class="ckc" name="checkid['+full[8]+']" value="' + $('<div/>').text(data).html() + '">';
                   }
                }, {
                   'targets': 4,
                   'className': 'dt-body-center',
                   'render': function (data, type, full, meta){
                    
                        if(full[4] == 0)
                            return '<span class="btn btn-secondary btn-sm">Not Active</span>';
                        else 
                            return '<span class="btn btn-success btn-sm">Active</span>';
                   }
                },
                {
                   'targets': 5,
                   'className': 'dt-body-center',
                   'render': function (data, type, full, meta){
                        if(full[5] == 0)
                        return '<span class="btn btn-primary btn-sm">ON</span>';
                        else 
                        return '<span class="btn btn-danger btn-sm">Deleted</span>';
                   }
                }
            ],
            searching: false,
        }); 


       
        $('.checkall').change(function(){
            var cells = table.cells().nodes();
            $( cells ).find('.ckc:checkbox').prop('checked', $(this).is(':checked'));
        });

        appendDivisionOption();
        appendRoleOption();
        

    });



    ////////////////////////////// Add Modal
    function addModal(){
        idx = $('#editbtn').attr('data-attid');
        $("#name").val("");
        $("#email").val("");
        $("#no_tlp").val("");
        $("#addmodall").modal('show');
        $("#icon").html("<i class='bi bi-person-plus-fill'></i>");
        $("#titleaddmodal").html("Add Modal");
        $("#addvbtn").hide();
        $("#deletevbtn").hide();
        $("#undeletevbtn").hide();
        
    }

    $(document).ready(function(){
    
    // idx = $('#save').attr('data-attid');
    // test = '@csrf';
    // token = $(test).val();
        
    $('#save').click(function(e){
        var url= "{{ asset('/customers/store') }}" ;
        idx = $('#editbtn').attr('data-attid');
        if(idx != "")
        var url = "{{ asset('/customers/update') }}/" + idx ;
        
        e.preventDefault();
        var form = $('#formm');
                $.ajax({
                    type: "POST",
                    url: url,
                    data: form.serialize(),
                    success: function (response) {
                        data = response.data;
                        if(data[0] == 'success') {
                            Swal.fire({
                                title: 'Selamat!',
                                text: "Data Berhasil Disimpan",
                                icon: 'success'
                            });
                            $("#addmodall").modal('hide');
                            $("#formm")[0].reset();
                            reloaddata();
                        } else {
                            Swal.fire({
                                title: 'Gagal!',
                                text: "Jabatan Sudah Terdaftar!",
                                icon: 'error'
                            });
                            
                        }
                        
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            });  
    });


    function showdetail(id) {
            var addurl = $('#addvbtn').attr('data-attrref')+'/'+id;
            $('#addvbtn').attr('href', addurl);
            $('#saveee').attr('data-attid', id);
            var addurl = $('#deletevbtn').attr('data-attid', id);
            var url = "{{ asset('/customers/detail') }}/" + id;
            var form = $('#viewCustomer');
            $('#undeletevbtn').html("Undelete");
                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        data = response.data;
                        if (data) {
                            $("#show_name").html(data.name);
                            $("#show_email").html(data.email);
                            $("#show_no_tlp").html(data.no_tlp);
                            if (data.active == 0) {
                                $("#activedetail").html("<span class='btn btn-secondary btn-sm'><b>Not Active</b></span>");
                            } else {
                                $("#activedetail").html("<span class='btn btn-success btn-sm'><b>Active</b></span>");
                            }
                            if (data.flag_delete == 0) {
                                $("#flagdelete").html("<span class='btn btn-primary btn-sm'><b>ON</b></span>");
                            } else {
                                $("#flagdelete").html("<span class='btn btn-danger btn-sm'><b>Delete</b></span>");
                            }

                            if (data.flag_delete == 0){
                                $('#deletevbtn').show();
                                $('#undeletevbtn').hide();
                            }
                            if (data.flag_delete == 1){
                                $('#deletevbtn').hide();
                                $('#undeletevbtn').show();
                            }
                            
                        }
                        reloaddata();
                        $('#viewCustomer').modal('show');
                
                    }
                }); 
            $('#deletevbtn').attr('data-attid', id);
            $('#editbtn').attr('data-attid', id);
            $('#undeletevbtn').attr('data-attid', id);
            $('#deletevbtn').html('<i class="fa fa-trash"></i> Delete Divisi');
            $("#titledetailmodal").html("Detail Customer")
        }
            $("#closeModalViewUser").click(function() {
                $("#viewCustomer").modal('hide');
            });


    function editshow(){
        idx = $('#editbtn').attr('data-attid',);
        $('#addmodall').modal('show');
        $('#viewCustomer').modal('hide');
        $("#icon").html("<i class='bi bi-pencil-square'></i>");
        $("#titleaddmodal").html("Edit Modal");
        var url = "{{ asset('/customers/edit') }}/" + idx;
                $.ajax({
                    url: url,
                    type: "GET",
                        success: function(response) {
                            data = response.data;
                                if(data) {
                                    $("#name").val(data.name);
                                    $("#email").val(data.email);
                                    $("#no_tlp").val(data.no_tlp);
                                    if(data.active == 0){
                                        $("#active2").attr('checked', true);
                                    }
                                    else {
                                        $("#active").attr('checked', true);
                                            }
                                }
                                $("#closemodaledit").modal('hide');
                                
                                $("#editmodal").modal('show');
                        }
                        
                });
    }

    function appendDivisionOption(){
        // add division
        var url = "{{ asset('/api/getdivision') }}";
        $.ajax({
            url: url,
            type: "get",
            success: function (response) {
              $.each(response.data, function (i, item) {
                  $('#division').append($('<option>', { 
                      value: item.id_division,
                      text : item.division_name 
                  }));
              });
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
    }

    function appendRoleOption(){
        // add division
        var url = "{{ asset('/api/getrole') }}";
        $.ajax({
            url: url,
            type: "get",
            success: function (response) {
              $.each(response.data, function (i, item) {
                  $('#role').append($('<option>', { 
                      value: item.id_role,
                      text : item.role_name 
                  }));
              });
            },
            error: function(jqXHR, textStatus, errorThrown) {
               console.log(textStatus, errorThrown);
            }
        });
    }

    function deleteyesshow(){
      $('#deletevbtn').hide();
      idx = $('#deletevbtn').attr('data-attid');
      test = '@csrf';
      token = $(test).val();
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
            if (result.isConfirmed) {
                var url = "{{ asset('/customers/delete') }}/" + idx;
                $.ajax({
                    url: url,
                    type: "get",
                    data: {
                        id : idx,
                        _token: token
                    },
                    success: function (response) {
                        Swal.fire({
                          icon: 'success',
                          title: 'Deleted',
                          html:'Your file has been <b>Deleted</b>'
                        });
                        reloaddata();
                        $("#viewCustomer").modal("hide");
                        $("#activspan").html('deleted');
                        $("#activspan").css('color', '#dc3545');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('something wrong');
                        console.log(textStatus, errorThrown);
                    }
                });

            } else {
              $('#deletevbtn').show();
            }
      })
    }

    function undeleteyesshow(){
      $('#undeletevbtn').hide();
      idx = $('#undeletevbtn').attr('data-attid');
      test = '@csrf';
      token = $(test).val();
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, undelete it!'
      }).then((result) => {
            if (result.isConfirmed) {
                var url = "{{ asset('/customers/delete') }}/" + idx;
                $.ajax({
                    url: url,
                    type: "get",
                    data: {
                        id : idx,
                        _token: token,
                        undeleted : 1
                    },
                    success: function (response) {
                        Swal.fire({
                          icon: 'success',
                          title: 'Undeleted',
                          html:'Your file has been <b>Undeleted</b>'
                        });
                        reloaddata();
                        $("#viewCustomer").modal("hide");
                        $("#activspan").html('-');
                        $("#activspan").css('color', '#198754');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });

            } else {
              $('#undeletevbtn').show();
            }
      })
    }

    function reloaddata() {
                $('#userstable').DataTable().ajax.url(url).load();
            }

    
</script>

@endsection    
</x-app-layout>


