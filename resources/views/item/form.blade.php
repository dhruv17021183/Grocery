<div class="container">
    <div class="form-group">
        <label>Item Name</label>
        <input type="text" name="name" class="form-control"
            value="{{ old('name', $item->item_name ?? null) }}"/>
    </div>
    
    <div class="form-group">
        <label>Item Content</label>
        <input type="text" name="content" class="form-control"
            value="{{ old('content', $item->item_content ?? null) }}"/>
    </div>

    <div class="form-group">
        <label>Item Category</label>
        {{-- <input type="text" name="category" class="form-control"
            value="{{ old('category', $item->item_category ?? null) }}"/> --}}
            <select class="form-select" aria-label="Default select example" name="category">
                    <option>Fruits & vagetable</option>
                    <option>Bakery Cakes & Diary</option>
                    <option>Snacks & Branded Foods</option>
                    <option>Cleaning & House Holds</option>
                    <option>Baby Care</option>
                    <option>Beauty & Hygiene</option>
                    <option>Oil & Masala</option>
                    <option>Snacks & Branded Foods</option>
            </select>
    </div>

    <div class="form-group">
        <label>Price</label>
        <input type="number" name="price" class="form-control"
            value="{{ old('price', $item->price ?? null) }}"/>
    </div>

    <div class="form-group">
        <label>Status</label>
        <input type="text" name="status" class="form-control"
            value="{{ old('status', $item->status ?? null) }}"/>
    </div>
    <div class="form-group">
        <label>Item Image:</label>
        <br>
        <input type="file" name="thumbnail" value="thumbnail" class="form-control-file"/>
    </div>
</div>
