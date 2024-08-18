<div class="container mt-5">
    <h2 class="mb-4">รายงานการปฏิบัติงาน</h2>
    <form action="show.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">ชื่อ:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>
        <div class="mb-3">
            <label for="jobname" class="form-label">ชื่องาน:</label>
            <input type="text" class="form-control" id="jobname" name="jobname">
        </div>
        <div class="mb-3">
            <label for="images" class="form-label">รูปภาพ:</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">ส่งข้อมูล</button>
    </form>
</div>
</body>