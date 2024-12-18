<div class="container mt-5">
        <button type="button" class="btn btn-danger" id="add_name">
            กดดู
        </button>
        <div id="show_aria">
            <div id="text" >
                {{-- <input type="text" name="name_[]" class="form-control">
                <button class="btn btn-danger" type="button" onclick="removediv()">ลบ</button> --}}
            </div>
        </div>
    </div>
    

    <script>
        var show_aria = document.getElementById('show_aria') ; 
        var add_name = document.getElementById('add_name') ; 
        var count = 0 ;
        add_name.addEventListener('click',function(){
            count++ ; 
            var create_div = document.createElement('div') ; 
            create_div.id = 'text'+count ; 
            input = 
                '<input type="text" name="name_['+count+']" class="form-control">'  + 
                '<button class="btn btn-danger" type="button" onclick="removediv('+count+')">ลบ</button> ' ; 
                create_div.innerHTML = input ; 
                show_aria.appendChild(create_div) ; 
        }) ; 
        function removediv(count){
            var delete_div = document.getElementById('text'+count) ; 
            delete_div.remove() ; 
        }
    </script>