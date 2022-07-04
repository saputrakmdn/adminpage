@extends('adminlte::page')

@section('title', 'Kelas')
@section('plugins.Datatables', true)

@section('content_header')
    <h1>Kelas</h1>
@stop

@php
    $heads = [
        'Nama Kelas',
        'Nama Jurusan',
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
        'columns' => [null, null, ['orderable' => false]],
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
    <x-adminlte-button label="Primary" theme="primary" label="Tambah Kelas" icon="fa fa-fw fa-plus-circle" data-toggle="modal" data-target="#addKelas"/>
    <br>
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" :config="$config" striped hoverable bordered compressed>
        @foreach($kelas as $row)
            <tr>
                <td>{{$row->nama_kelas}}</td>
                <td>{{$row->nama_jurusan}}</td>
                <td><nobr>
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow edit-kelas" data-id="{{$row->id_kelas}}" title="Edit" data-toggle="modal" data-target="#editKelas">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow delete-kelas" data-id="{{$row->id_kelas}}" title="Delete" data-toggle="modal" data-target="#deletekelas">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </nobr>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>

    {{-- Modal Tambah --}}
    <x-adminlte-modal id="addKelas" title="Tambah Kelas">
        <form id="add_kelas" action="{{route('kelas.store')}}" method="post">
            {{ csrf_field() }}
            <x-adminlte-input name="nama_kelas" label="Nama Kelas" required value="{{old('nama_kelas')}}" placeholder="Nama Kelas" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user-circle text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
           <x-adminlte-select name="id_jurusan" label="Jurusan" required label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-venus-mars text-lightblue"></i>
                    </div>
                </x-slot>
                <option>-Pilih Jurusan-</option>
                @foreach($jurusan as $data)
                <option value="{{$data->id_jurusan}}">{{strtoupper($data->kode_jurusan)}}-{{$data->nama_jurusan}}</option>
                @endforeach
               
            </x-adminlte-select>
            <x-adminlte-button label="Submit" type="submit" theme="primary" icon="fa fa-fw fa-paper-plane"/>
        </form>
    </x-adminlte-modal>

{{--    Modal Edit--}}
    <x-adminlte-modal id="editKelas" title="Edit Kelas">
        <form id="edit_kelas" action="{{route('kelas.store')}}" method="post">
            <input type="hidden" name="id_kelas" id="id_kelas">
            {{ csrf_field() }}
            <x-adminlte-input name="edit_nama_kelas" label="Nama Kelas" required value="{{old('nama_kelas')}}" placeholder="Nama Kelas" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user-circle text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-select id="edit_id_jurusan" name="edit_id_jurusan" label="Jurusan" required label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-venus-mars text-lightblue"></i>
                    </div>
                </x-slot>
                <option>-Pilih Jurusan-</option>
                @foreach($jurusan as $data)
                <option value="{{$data->id_jurusan}}">{{strtoupper($data->kode_jurusan)}}-{{$data->nama_jurusan}}</option>
                @endforeach
               
            </x-adminlte-select>
            <x-adminlte-button label="Submit" type="submit" theme="primary" icon="fa fa-fw fa-paper-plane"/>
        </form>
    </x-adminlte-modal>

{{--    Modal Delete--}}
    <x-adminlte-modal id="deleteKelas" title="Hapus Kelas" >
        <div>Apakah Yakin Menghapus Data Kelas?</div>

        <x-slot name="footerSlot">
            <form id="delete_kelas" action="{{route('kelas.store')}}" method="post">
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
        $('.edit-kelas').click(function () {
            $('#edit_kelas').attr('action', window.location+'/update/'+$(this).data('id'));
            $.ajax({
                method: 'get',
                url: window.location+'/edit/'+$(this).data('id'),
                success: function (response) {
                    var data = response.data;
                    console.log(data);
                    $("#edit_nama_kelas").val(data.nama_kelas);
                    $('#edit_id_jurusan').val(data.id_jurusan);
                }
            })
        });

        $('.delete-kelas').click(function (){
            $('#delete_kelas').attr('action', window.location+'/delete/'+$(this).data('id'));
        })
       ///asas
    </script>
@stop
