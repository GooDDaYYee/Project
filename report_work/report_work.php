<form action="show.php" method="post" enctype="multipart/form-data">
    <!-- Begin Page Content -->
    <div class="card o-hidden border-0 shadow-lg my-5 align-items-center">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h2 text-gray-900 mb-2">รายงานการปฏิบัติงาน</h1>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="name" class="form-label">ชื่อ:</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="col">
                                <label for="jobname" class="form-label">ชื่องาน:</label>
                                <input type="text" class="form-control" id="jobname" name="jobname">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col">
                                <label for="images" class="form-label">รูปภาพ:</label>
                                <input type="file" class="form-control" id="images" name="images[]" multiple accept="image/*">
                            </div>
                        </div>
                        <button class="btn btn-warning bg-gradient-purple btn-user btn-block col-sm-4 container" id="insert_users" type="submit">
                            <h5>เพิ่มข้อมูล</h5>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>