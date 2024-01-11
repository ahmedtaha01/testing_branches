<table class="table">
        <thead>
            <tr>
                <td>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="checkAll" onclick="checkAll()">
                    </div>
                </td>
                <td>ID</td>
                <td>name</td>
                <td>description</td>
            </tr>
        </thead>
        <tbody>
            @forelse ($products as $product)
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="boxes"
                            class='singleCheckBox' data="{{ $product->id }}" onclick="checkSingle(this)">
                        </div>
                    </td>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                </tr>
                
            @empty
                <tr>
                    <td>
                        No data    
                    </td>
                </tr>    
            @endforelse
                
           
        </tbody>
    </table>