<form action="{{ route('expenses.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="expenses_name" class="form-label">ชื่อค่าใช้จ่าย</label>
        <input type="text" class="form-control" id="expenses_name" name="expenses_name" required>
    </div>
    <div class="mb-3">
        <label for="expenses_price" class="form-label">ราคา (บาท)</label>
        <input type="number" class="form-control" id="expenses_price" name="expenses_price" required>
    </div>
    <div class="mb-3">
        <label for="expenses_date" class="form-label">วันที่</label>
        <input type="date" class="form-control" id="expenses_date" name="expenses_date" required>
    </div>
    <button type="submit" class="btn btn-primary">เพิ่มค่าใช้จ่าย</button>
</form>
