@extends('adminlte::page')

@section('title', 'Jurusan')
@section('plugins.Datatables', true)

@section('content_header')
    <h1>Jurusan</h1>
@stop

@php
    $heads = [
        'Nama Jurusan',
        'Kode Jurusan',
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
    <x-adminlte-button label="Primary" theme="primary" label="Tambah Jurusan" icon="fa fa-fw fa-plus-circle" data-toggle="modal" data-target="#addJurusan"/>
    <br>
    <x-adminlte-datatable id="table1" :heads="$heads" head-theme="dark" :config="$config" striped hoverable bordered compressed>
        @foreach($jurusan as $row)
            <tr>
                <td>{{$row->nama_jurusan}}</td>
                <td>{{$row->kode_jurusan}}</td>
                <td><nobr>
                        <button class="btn btn-xs btn-default text-primary mx-1 shadow edit-jurusan" data-id="{{$row->id_jurusan}}" title="Edit" data-toggle="modal" data-target="#editJurusan">
                            <i class="fa fa-lg fa-fw fa-pen"></i>
                        </button>
                        <button class="btn btn-xs btn-default text-danger mx-1 shadow delete-jurusan" data-id="{{$row->id_jurusan}}" title="Delete" data-toggle="modal" data-target="#deletejurusan">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </nobr>
                </td>
            </tr>
        @endforeach
    </x-adminlte-datatable>

    {{-- Modal Tambah --}}
    <x-adminlte-modal id="addJurusan" title="Tambah Jurusan">
        <form id="add_jurusan" action="{{route('jurusan.store')}}" method="post">
            {{ csrf_field() }}
            <x-adminlte-input name="nama_jurusan" label="Nama Jurusan" required value="{{old('nama_jurusan')}}" placeholder="Nama Jurusan" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user-circle text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
              <x-adminlte-input name="kode_jurusan" label="Kode Jurusan" required value="{{old('kode_jurusan')}}" placeholder="Kode Jurusan" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user-circle text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-button label="Submit" type="submit" theme="primary" icon="fa fa-fw fa-paper-plane"/>
        </form>
    </x-adminlte-modal>

{{--    Modal Edit--}}
    <x-adminlte-modal id="editJurusan" title="Edit Jurusan">
        <form id="edit_jurusan" action="{{route('jurusan.store')}}" method="post">
            <input type="hidden" name="id_kelas" id="id_jurusan">
            {{ csrf_field() }}
            <x-adminlte-input name="edit_nama_jurusan" label="Nama Jurusan" required value="{{old('nama_jurusan')}}" placeholder="Nama Jurusan" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-user-circle text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-input name="edit_id_jurusan" type="number" label="Kode Jurusan" required placeholder="Kode Jurusan" value="{{old('id_jurusan')}}" label-class="text-lightblue">
                <x-slot name="prependSlot">
                    <div class="input-group-text">
                        <i class="fas fa-id-card text-lightblue"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>
            <x-adminlte-button label="Submit" type="submit" theme="primary" icon="fa fa-fw fa-paper-plane"/>
        </form>
    </x-adminlte-modal>

{{--    Modal Delete--}}
    <x-adminlte-modal id="deleteJurusan" title="Hapus Jurusan" >
        <div>Apakah Yakin Menghapus Data Jurusan?</div>

        <x-slot name="footerSlot">
            <form id="delete_jurusan" action="{{route('jurusan.store')}}" method="post">
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
        $('.edit-jurusan').click(function () {
            $('#edit_jurusan').attr('action', window.location+'/update/'+$(this).data('id'));
            $.ajax({
                method: 'get',
                url: window.location+'/edit/'+$(this).data('id'),
                success: function (response) {
                    var data = response.data;
                    console.log(data);
                    $("#edit_nama_jurusan").val(data.nama_jurusan);
                    $('#id_jurusan').val(data.id_jurusan);
                }
            })
        });

        $('.delete-Jurusan').click(function (){
            $('#delete_jurusan').attr('action', window.location+'/delete/'+$(this).data('id'));
        })
       ///asas
    </script>
@stop
