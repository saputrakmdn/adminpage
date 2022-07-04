@extends('adminlte::page')

@section('title', 'Guru')
@section('plugins.Datatables', true)

@section('content_header')
    <h1>Guru</h1>
@stop

@php
    $heads = [
        'NIP',
        'Nama Guru',
        'Username',
        ['label' => 'Actions', 'no-export' => true, 'width' => 5],
    ];

    $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                    <i class="fa fa-lg fa-fw fa-pen"></i>
                </button>';
    $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                      <i class="fa fa-lg fa-fw fa-trash"></i>
                  </button>';
    $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                       <i class="fa fa-lg fa-fw fa-eye"></i>
                   </button>';

    $config = [
        'order' => [[1, 'asc']],
        'columns' => [null, null, null, ['orderable' => false]],
    ];


@endphp

@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $error)
        <x-adminlte-alert theme="danger" title="Error">
           <p>{{ $error }}</p>
        </x-adminlte-alert>
        @endforeach
    @endif
    @if (session('status'))
    <x-adminlte-alert theme="success" title="Success">
        {{session('status')}}
    </x-adminlte-alert>
    @endif
    <x-adminlte-button label="Primary" theme="primary" label="Tambah Guru" icon="fa fa-fw fa-plus-circle" data-toggle="modal" data-target="#addGuru"/>
    <br>
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" :config="$config" striped hoverable bordered compressed>
        @foreach($guru as $row)
            <tr>
                <td>{{$row->nip}}</td>
                <td>{{$row->nama_Guru}}</td>
                <td>{{$row->username}}</td>
                <td><nobr>
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow edit-guru" data-id="{{$row->id_guru}}" title="Edit" data-toggle="modal" data-target="#editGuru">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow delete-guru" data-id="{{$row->id_guru}}" title="Delete" data-toggle="modal" data-target="#deleteguru">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </nobr>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>

    {{-- Modal Tambah --}}
    <x-adminlte-modal id="addGuru" title="Tambah Guru">
        <form id="add_guru" action="{{route('guru.store')}}" method="post">
            {{ csrf_field() }}
            <x-adminlte-input name="nip" type="number" label="NIP" required placeholder="NIP" value="{{old('nip')}}" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-id-card text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-input name="nama_guru" label="Nama Guru" required value="{{old('nama_guru')}}" placeholder="Nama Guru" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user-circle text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-input name="username" label="Username" value="{{old('username')}}" required placeholder="Username" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-input name="password" type="password" required label="Password" value="" placeholder="Password" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-key text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-button label="Submit" type="submit" theme="primary" icon="fa fa-fw fa-paper-plane"/>
        </form>
    </x-adminlte-modal>

{{--    Modal Edit--}}
    <x-adminlte-modal id="editGuru" title="Edit Guru">
        <form id="edit_guru" action="{{route('guru.store')}}" method="post">
            <input type="hidden" name="id_guru" id="id_guru">
            {{ csrf_field() }}
            <x-adminlte-input name="edit_nip" type="number" label="NIP" required placeholder="NIP" value="{{old('nip')}}" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-id-card text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-input name="edit_nama_guru" label="Nama Guru" required value="{{old('nama_guru')}}" placeholder="Nama Guru" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user-circle text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-input name="edit_username" label="Username" value="{{old('username')}}" required placeholder="Username" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-input name="edit_password" type="password" label="Password" value="{{old('password')}}" placeholder="Password" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-key text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-button label="Submit" type="submit" theme="primary" icon="fa fa-fw fa-paper-plane"/>
        </form>
    </x-adminlte-modal>

{{--    Modal Delete--}}
    <x-adminlte-modal id="deleteGuru" title="Hapus Guru" >
        <div>Apakah Yakin Menghapus Data Guru?</div>

        <x-slot name="footerSlot">
            <form id="delete_guru" action="{{route('guru.store')}}" method="post">
                {{ csrf_field() }}
                <x-adminlte-button type="submit" class="mr-auto" theme="success" label="Ya"/>
                <x-adminlte-button theme="danger" label="Tidak" data-dismiss="modal"/>
            </form>
        </x-slot>
    </x-adminlte-modal>
@stop

@section('css')
{{--    <link rel="stylesheet" href="{{asset('vendor/css/admin_custom.css')}}">--}}
@stop

@section('js')
    <script>
        $('.edit-guru').click(function () {
            $('#edit_guru').attr('action', window.location+'/update/'+$(this).data('id'));
            $.ajax({
                method: 'get',
                url: window.location+'/edit/'+$(this).data('id'),
                success: function (response) {
                    var data = response.data;
                    console.log(data);
                    $("#edit_nip").val(data.nip);
                    $("#edit_nama_guru).val(data.nama_guru);
                    $("#edit_username").val(data.username);
                    $("#password").val(data.password);
                    $('#id_guru').val(data.id_guru);
                }
            })
        });

        $('.delete-guru').click(function (){
            $('#delete_guru').attr('action', window.location+'/delete/'+$(this).data('id'));
        })
       ///asas
    </script>
@stop
