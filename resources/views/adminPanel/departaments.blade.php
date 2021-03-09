@extends('welcome')

@section('title','Панель администратора')

@section('content')
    <div class="projects-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Отделения</h2>
                <p class="text-center">Просмотр всех отделений, их редактирование, удаление и добавление</p>
            </div>
            <div class="row projects">
                <table style="width: 100%">
                    <div class="container-fluid d-flex justify-content-end">
                        <div title="Добавить новое отделение" data-toggle="collapse" href="#addDep" role="button" aria-expanded="false" aria-controls="collapseExample" style="text-align: right">
                            <span class="btn btn-success">Добавить</span>
                        </div>
                    </div>
                    <tr>
                        <th>Название</th>
                        <th></th>
                    </tr>
                    <tr class="collapse" id="addDep">
                        <form action="/ap/add_departaments" method="post" enctype="multipart/form-data">
                        @csrf
                            <td>
                                <textarea name="title" id="title" style="width: 100%" required></textarea>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                        </form>
                    </tr>
                    @foreach($departaments as $d)
                    <tr>
                        <td>{{ $d->title }}</td>
                        <td>
                            <form action="/ap/delete_departaments" method="post">
                            @csrf
                                <input type="text" name="id" id="id" value="{{ $d->id }}" hidden>
                                <button type="submit" class="btn btn-danger" title="Удалить">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <br>
                                <br>
                            </form>
                            <button class="btn btn-warning" data-toggle="collapse" href="#editDep{{$d->id}}" role="button" aria-expanded="false" aria-controls="collapseExample" title="Редактировать" >
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <tr class="collapse" id="editDep{{$d->id}}">
                        <form action="/ap/edit_departaments" method="post" enctype="multipart/form-data">
                        @csrf
                            <td>
                                <input type="text" name="id" id="id" value="{{ $d->id }}" hidden>
                                <textarea name="title"  id="title" style="width: 100%" required>{{$d->title}}</textarea>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-check"></i>
                                </button>
                            </td>
                        </form>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@endsection