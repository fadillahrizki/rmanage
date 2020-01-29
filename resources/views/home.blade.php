@extends('layouts.app')
@section('title','Home')
@section('content')
<div class="container">
    <div class="row" id="content">
    <br>
        <div class="progress">
            <div class="indeterminate"></div>
        </div> 
    </div>
</div>

<div id="add_menu" class="modal">
    <div class="modal-content">
        <h4>Add Menu</h4>

            <div class="input-field">
                <label for="name">Name</label>
                <input type="text" class="validate" name="name" required id="name">
                <button class="btn purple darken-3" onclick="createMenu()">
                    <i class="material-icons left">add</i>Add
                </button>
            </div>

    </div>
</div>

<div id="edit_menu" class="modal">
    <div class="modal-content">
        <h4>Edit Menu</h4>
        <div class="input-field" id="edit_content">
            
        </div>
    </div>
</div>

@endsection

@section('script')

    <script>
        function init(){
            $.get("{{route('get')}}",function(data, status){
                var html = "";
                data.forEach(function(menu){
                    html += `
                            <div class="col m12 l4 center-align">
                                <div class="card purple darken-3 white-text">
                                    <a href="{{route('menu.single',':menu.id')}}">
                                        <div class="card-image">
                                            <img src="{{url('storage/menus/card.jpg')}}" alt="">
                                        </div>
                                    </a>
                                    <div class="card-content">
                                        <div class="card-title">
                                            ${menu.name}
                                            <button class="btn purple darken-4 right" onclick="deleteMenu(${menu.id})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <button class="btn purple right" onclick="dataEdit(${menu.id},'${menu.name}')">
                                                <i class="material-icons">edit</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                    `;
                    html = html.replace(':menu.id', menu.id);
                }); 
                html+= `
                    <a href="#add_menu" class="modal-trigger">
                        <div class="col m12 l4 center-align">
                            <div class="card purple darken-3 white-text">
                                <div class="card-content">
                                    <i class="medium material-icons">add</i>
                                </div>
                            </div>
                        </div>
                    </a>
                `;
                $("#content").html(html);
            });
        }

        init();

        function createMenu(){
            var url = "{{route('menu.create')}}";
            var data = {name:$("#name").val()};
            $.ajax({
                url:url,
                data:data,
                type:"post",
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(result){
                    $(".modal").modal('close');
                    M.toast({html:result.message});
                    $("#name").val(" ");
                    init();
                }
            })
        }

        function dataEdit(id,name){
            var html = "";
            html+= `
                <label for="edit_name" class="active">Name</label>
                <input type="text" class="validate" name="name" required id="edit_name" value="${name}">
                <button class="btn purple darken-3" onclick="editMenu(${id})">
                    <i class="material-icons left">edit</i>edit
                </button>
            `;
            $("#edit_content").html(html);
            $("#edit_menu").modal("open");
        }

        function editMenu(id){
            var url = "{{route('menu.update',':id')}}";
            url = url.replace(':id',id);
            var data = {name:$("#edit_name").val()};
            $.ajax({
                url:url,
                data:data,
                type:'PUT',
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(result){
                    $(".modal").modal('close');
                    M.toast({html:result.message})
                    init();
                }
            })
        }

        function deleteMenu(id){
            var url = "{{route('menu.delete',':id')}}";
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type:'delete',
                success:function(result){
                    M.toast({html:result.message});
                    init();
                }
            });
        }
    </script>

@endsection
