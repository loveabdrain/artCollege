@extends('welcome')

@section('title','Панель администратора')

@section('content')
@if(Auth::user())
    <div class="projects-clean">
        <div class="container">
            <div class="intro">
                <h2 class="text-center">Директора</h2>
                <p class="text-center">Просмотр всех директоров, их редактирование, удаление и добавление</p>
            </div>
            <div class="row projects">
                <table>
                    <div class="container-fluid d-flex justify-content-end">
                        <div title="Добавить нового директора" colspan="3" data-toggle="collapse" href="#addDir" role="button" aria-expanded="false" aria-controls="collapseExample" style="text-align: right">
                            <span class="btn btn-success">Добавить</span>
                        </div>
                    </div>
                    <tr>
                        <th>Фото</th>
                        <th>ФИО</th>
                        <th>Описание</th>
                        <th></th>
                    </tr>
                    <tr class="collapse" id="addDir">
                        <form action="/ap/add_directors" method="post" enctype="multipart/form-data">
                        @csrf
                            <td>
                                <input type="file" accept="image/*" name="image" id="image" required>
                            </td>
                            <td>
                                <input type="text" name="name" id="name" required>
                            </td>
                            <td>
                                <textarea name="description" id="description" style="width: 100%;" required></textarea>
                            </td>
                            <td class="buttons">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </td>
                        </form>
                    </tr>
                    @foreach($directors as $d)
                    <tr>
                        <td><img src="/assets/img/directors/{{ $d->image }}" width="200" alt="{{ $d->name }}"></td>
                        <td>{{ $d->name }}</td>
                        <td>{{ $d->description }}</td>
                        <td class="buttons">
                            <form action="/ap/delete_directors" method="post">
                            @csrf
                                <input type="text" name="id" id="id" value="{{ $d->id }}" hidden>
                                <button type="submit" class="btn btn-danger" title="Удалить">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                <br>
                                <br>
                            </form>
                            <button class="btn btn-warning" data-toggle="collapse" href="#editDir{{$d->id}}" role="button" aria-expanded="false" aria-controls="collapseExample" title="Редактировать" >
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <tr class="collapse" id="editDir{{$d->id}}">
                        <form action="/ap/edit_directors" method="post" enctype="multipart/form-data">
                        @csrf
                            <td>
                                <input type="text" name="id" id="id" value="{{ $d->id }}" hidden>
                                <input type="file" accept="image/*" name="image" id="image">
                            </td>
                            <td>
                                <textarea name="name" id="name" required>{{$d->name}}</textarea>
                            </td>
                            <td>
                                <textarea name="description" id="description" style="width: 100%; min-height:100px;" required>{{$d->description}}</textarea>
                            </td>
                            <td class="buttons">
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
@else
    <h1>Данный раздел доступен только администратору</h1>
@endif
@endsection