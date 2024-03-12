@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-3">
            <div class="sidebar" id="sidebar">
                <div class="text-center">
                    <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#createAdModal">
                        Создать объявление
                    </button>
                </div>
                <h2>Категории</h2>
                <ul>
                    <li><a href="#">Автомобили</a></li>
                    <li><a href="#">Недвижимость</a></li>
                    <li><a href="#">Работа</a></li>
                    <li><a href="#">Электротехника</a></li>
                    <li><a href="#">Пропажи</a></li>
                    <li><a href="#">Розыск</a></li>
                    <li><a href="#">Домашние животные</a></li>
                </ul>
            </div>
        </div>
        <div class="col-9">
            <div class="burger-menu" onclick="toggleSidebar()">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </div>

        </div>
    </div>
    <div class="container-fluid">

        @if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
        @endif

        @if(Auth::check())
        <div class="modal fade" id="createAdModal" tabindex="-1" aria-labelledby="createAdModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createAdModalLabel">Создать объявление</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body">
                        <!-- Форма для создания объявления -->
                        <form action="{{ route('post.create') }}" method="POST" enctype='multipart/form-data'>
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Заголовок</label>
                                <input type="text" class="form-control" id="Title" name="Title" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Описание</label>
                                <textarea class="form-control" id="Description" name="Description" rows="3" required></textarea>
                            </div>
                            
                            <label for="formFile" class="form-label">Изображение</label>
                            <input class="form-control" type="file" id="AdPhoto" name="AdPhoto">

                            <div class="mb-3">
                                <label for="category" class="form-label">Категория</label>
                                <select class="form-select" id="CategoryID" name="CategoryID" required>
                                    <option selected disabled>Выберите категорию</option>
                                    <option value="1">Автомобили</option>
                                    <option value="2">Недвижимость</option>
                                    <option value="3">Работа</option>
                                    <option value="4">Электротехника</option>
                                    <option value="5">Пропажи</option>
                                    <option value="6">Розыск</option>
                                    <option value="7">Домашние животные</option>
                                    
                                    
                                </select>
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Создать</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <table class="table">
            <thead class="thead-dark">
              <tr>

                <th scope="col">ID</th>
                <th scope="col">Username</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th scope="col">created_at</th>
                <th scope="col">updated_at</th>
              </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <form method="POST" action="{{ route('admin2') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{$user->id}}">
                        <td>{{$user->id}}</td>
                        <td><input type="text" name="Username" value="{{$user->Username}}"></td>
                        <td><input type="email" name="Email" value="{{$user->Email}}"></td>
                        <td>
                            <select name="Role">
                                <option value="0" style="color: grey" {{$user->Role == 0 ? 'selected' : ''}}> Пользователь</option>
                                <option value="1" style="color: green" {{$user->Role == 1 ? 'selected' : ''}}>Админ</option>
                                <option value="2" style="color: red" {{$user->Role == 2 ? 'selected' : ''}}>Забанен</option>
                            </select>
                        </td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->updated_at}}</td>
                        <td>
                            <button type="submit" class="btn btn-primary">Save</button> <!-- Кнопка сохранения изменений -->
                        </td>
                    </form>
                </tr>
                @endforeach
            </tbody>
          </table>
          

    
    </div>

    <script>
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }
    </script>
@endsection
