@extends('layouts.app')
@section('title','Menu')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <h4>{{$menu->name}}</h4>
                <a href="{{route('home')}}" class="btn purple darken-3">
                    <i class="material-icons">arrow_back</i>
                </a>
            </div>
        </div>
        <div class="row" id="content">
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
    </div>   
    
    <div id="add_menu_item" class="modal">
        <div class="modal-content">
            <h4>Add Menu Item</h4>

                <div class="input-field">
                    <label for="name">Name</label>
                    <input type="text" class="validate" name="name" required id="name">
                    <button class="btn purple darken-3" onclick="createMenuItem({{$menu->id}})">
                        <i class="material-icons left">add</i>Add
                    </button>
                </div>

        </div>
    </div>

    <div id="edit_menu_item" class="modal">
        <div class="modal-content">
            <h4>Edit Menu Item</h4>
            <div class="input-field" id="edit_content">
                
            </div>
        </div>
    </div>

    <div id="add_item" class="modal">
        <div class="modal-content">
            <h4>Add Item</h4>
            <div class="input-field" id="item_content">
                
            </div>
        </div>
    </div>

    <div id="edit_item" class="modal">
        <div class="modal-content">
            <h4>Edit Item</h4>
            <div class="input-field" id="edit_item_content">
                
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script>

        // ITEM

        init({{$menu->id}});

        function init(id){
            var url = "{{route('menu.get',':id')}}";
            url = url.replace(':id',id);
            $.ajax({
                url:url,
                type:'GET',
                success:function(result){
                    var html = "";
                    
                    result.forEach(function(menuItem){
                        if(menuItem.items.length > 0){
                            var itemHtml = ``;
                            menuItem.items.forEach(function(item){
                                itemHtml += `
                                    <li class="collection-item purple darken-4">
                                        ${item.name}
                                        <i class="material-icons right" style="cursor:pointer" onclick="deleteItem({{$menu->id}},${menuItem.id},${item.id})">delete</i>
                                        <i class="material-icons right" style="cursor:pointer" onclick="dataEditItem({{$menu->id}},${menuItem.id},${item.id},'${item.name}')">edit</i>
                                    </li>
                                `;
                            })
                        }
                        html += `
                            <div class="col m12 l4 center-align">
                                <div class="card purple darken-3 white-text">
                                    <div class="card-content">
                                        <div class="card-title" style="font-size:20px;">
                                            ${menuItem.name}
                                            <button class="btn purple darken-4 right" onclick="deleteMenuItem({{$menu->id}},${menuItem.id})">
                                                <i class="material-icons">delete</i>
                                            </button>
                                            <button class="btn purple right" onclick="dataEdit({{$menu->id}},${menuItem.id},'${menuItem.name}')">
                                                <i class="material-icons">edit</i>
                                            </button>
                                        </div>
                                        <ul class="collection" id="sortable">
                                            ${(itemHtml) ? itemHtml : ''}
                                            <li class="collection-item purple darken-4" onclick="dataAddItem({{$menu->id}},${menuItem.id})" style="cursor:pointer;">
                                                <i class="material-icons">add</i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div> 
                        `;
                    });
                    html += `
                        <div class="col m12 l4 center-align">
                            <a href="#add_menu_item" class="modal-trigger">
                                <div class="card purple darken-3 white-text">
                                    <div class="card-content">
                                        <i class="medium material-icons">add</i>
                                    </div>
                                </div>
                            </a>
                        </div>
                    `;
                    $("#content").html(html);
                }
            });
        }

        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();

        // ADD ITEM

        function dataAddItem(menu_id,menu_item_id){
            var html = "";
            html+= `
                <label for="edit_name">Name</label>
                <input type="text" class="validate" name="name" required id="add_item_name">
                <button class="btn purple darken-3" onclick="addItem(${menu_id},${menu_item_id})">
                    <i class="material-icons left">edit</i>edit
                </button>
            `;
            $("#item_content").html(html);
            $("#add_item").modal("open");
        }

        function addItem(menu_id,menu_item_id){
            var url = "{{route('item.create',[':menu_id',':menu_item_id'])}}";
            url = url.replace(':menu_item_id',menu_item_id);
            url = url.replace(':menu_id',menu_id);
            var data = {name:$("#add_item_name").val()};
            $.ajax({
                url:url,
                data:data,
                type:'POST',
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(result){
                    $(".modal").modal('close');
                    M.toast({html:result.message})
                    init(menu_id);
                }
            })
        }

        // EDIT ITEM

        function dataEditItem(menu_id,menu_item_id,id,name){
            var html = "";
            html+= `
                <label for="edit_name" class="active">Name</label>
                <input type="text" class="validate" name="name" required id="edit_item_name" value="${name}">
                <button class="btn purple darken-3" onclick="editItem(${menu_id},${menu_item_id},${id})">
                    <i class="material-icons left">edit</i>edit
                </button>
            `;
            $("#edit_item_content").html(html);
            $("#edit_item").modal("open");
        }

        function editItem(menu_id,menu_item_id,id){
            var url = "{{route('item.update',[':menu_id',':menu_item_id',':id'])}}";
            url = url.replace(':id',id);
            url = url.replace(':menu_id',menu_id);
            url = url.replace(':menu_item_id',menu_item_id);
            var data = {name:$("#edit_item_name").val()};
            $.ajax({
                url:url,
                data:data,
                type:'PUT',
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(result){
                    $(".modal").modal('close');
                    M.toast({html:result.message})
                    init(menu_id);
                }
            })
        }

        // DELETE ITEM

        function deleteItem(menu_id,menu_item_id,id){
            var url = "{{route('item.delete',[':menu_id',':menu_item_id',':id'])}}";
            url = url.replace(':id',id);
            url = url.replace(':menu_id',menu_id);
            url = url.replace(':menu_item_id',menu_item_id);
            $.ajax({
                url:url,
                type:'DELETE',
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(result){
                    $(".modal").modal('close');
                    M.toast({html:result.message})
                    init(menu_id);
                }
            })
        }
    
        // MENU ITEM 

        // ADD MENU ITEM

        function createMenuItem(id){
            var url = "{{route('menu.item.create',':id')}}";
            url = url.replace(':id',id);
            var data = {name:$("#name").val()};
            $.ajax({
                url:url,
                data:data,
                type:"post",
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(result){
                    $(".modal").modal('close');
                    M.toast({html:result.message})
                    init(id);
                }
            })
        }

        // EDIT MENU ITEM

        function dataEdit(menu_id,id,name){
            var html = "";
            html+= `
                <label for="edit_name" class="active">Name</label>
                <input type="text" class="validate" name="name" required id="edit_name" value="${name}">
                <button class="btn purple darken-3" onclick="editMenuItem(${menu_id},${id})">
                    <i class="material-icons left">edit</i>edit
                </button>
            `;
            $("#edit_content").html(html);
            $("#edit_menu_item").modal("open");
        }

        function editMenuItem(menu_id,id){
            var url = "{{route('menu.item.update',[':menu_id',':id'])}}";
            url = url.replace(':id',id);
            url = url.replace(':menu_id',menu_id);
            var data = {name:$("#edit_name").val()};
            $.ajax({
                url:url,
                data:data,
                type:'PUT',
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(result){
                    $(".modal").modal('close');
                    M.toast({html:result.message})
                    init(menu_id);
                }
            })
        }

        // DELETE MENU ITEM

        function deleteMenuItem(menu_id,id){
            var url = "{{route('menu.item.delete',[':menu_id',':id'])}}";
            url = url.replace(':id',id);
            url = url.replace(':menu_id',menu_id);
            $.ajax({
                url:url,
                type:'DELETE',
                headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(result){
                    $(".modal").modal('close');
                    M.toast({html:result.message})
                    init(menu_id);
                }
            })
        }

    </script>

@endsection