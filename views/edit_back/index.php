<div class="text-center">
    <h1 class="h2 text-gray-900 mb-3">ข้อมูลเชิงลึก</h1>
</div>
<div class="container-xl">
    <div class="row">
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>เพิ่ม รับจากบริษัท</h4>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="username" name="username" class="form-control form-control-user" placeholder="รับจากบริษัท" required autofocus>
                        </div>
                        <div class="col">
                            <button class="btn btn-warning bg-gradient-purple" type="submit">
                                ตกลง
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <ul class="list-group">
                                <li class="list-group-item">An item</li>
                                <li class="list-group-item">A second item</li>
                                <li class="list-group-item">A third item</li>
                                <li class="list-group-item">A fourth item</li>
                                <li class="list-group-item">And a fifth one</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4 ">
            <div class="card">
                <div class="card-body">
                    <h4>เพิ่ม บริษัทผลิตสาย</h4>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="username" name="username" class="form-control form-control-user" placeholder="บริษัทผลิตสาย" required autofocus>
                        </div>
                        <div class="col">
                            <button class="btn btn-warning bg-gradient-purple" type="submit">
                                ตกลง
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <ul class="list-group">
                                <li class="list-group-item">An item</li>
                                <li class="list-group-item">A second item</li>
                                <li class="list-group-item">A third item</li>
                                <li class="list-group-item">A fourth item</li>
                                <li class="list-group-item">And a fifth one</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4 ">
            <div class="card">
                <div class="card-body">
                    <h4>เพิ่ม บริษัทที่ทำงาน</h4>
                    <div class="row">
                        <div class="col">
                            <input type="text" id="username" name="username" class="form-control form-control-user" placeholder="บริษัทที่ทำงาน" required autofocus>
                        </div>
                        <div class="col">
                            <button class="btn btn-warning bg-gradient-purple" type="submit">
                                ตกลง
                            </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <ul class="list-group">
                                <li class="list-group-item">An item</li>
                                <li class="list-group-item">A second item</li>
                                <li class="list-group-item">A third item</li>
                                <li class="list-group-item">A fourth item</li>
                                <li class="list-group-item">And a fifth one</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <h4>เพิ่ม AU ทั้งหมด</h4>
                    <p style="color: red;">*ข้อมูลเก่าจะถูกลบ และแทนที่ใหม่ทั้งหมด*</p>
                    <div class="row">
                        <form action="process.php" method="post" enctype="multipart/form-data">
                            <div class="col">
                                <input type="file" name="excelFile" accept=".xlsx, .xls" required>
                            </div>
                            <div class="col mt-2">
                                <input type="submit" value="Upload and Process">
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-12 mt-4">
                            <h4>รายละเอียด</h4>
                            <p>AU : ทั้งหมด 555 รายการ | Mixed : 555 รายการ | FBH : 555 รายการ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="col">
                        <h4>แก้ไขข้อมูลธนาคารภายใน Bill</h4>
                        <form action="process.php" method="post" enctype="multipart/form-data">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                        </form>
                    </div>
                    <div class="col mt-3 text-center">
                        <button class="btn btn-warning bg-gradient-purple" type="submit">
                            ตกลง
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="col">
                        <h4>แก้ไขข้อมูลที่อยู่บริษัท Mixed</h4>
                        <form action="process.php" method="post" enctype="multipart/form-data">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                        </form>
                    </div>
                    <div class="col mt-3 text-center">
                        <button class="btn btn-warning bg-gradient-purple" type="submit">
                            ตกลง
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="col">
                        <h4>แก้ไขข้อมูลที่อยู่บริษัท FBH</h4>
                        <form action="process.php" method="post" enctype="multipart/form-data">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                        </form>
                    </div>
                    <div class="col mt-3 text-center">
                        <button class="btn btn-warning bg-gradient-purple" type="submit">
                            ตกลง
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="col">
                        <h4>แก้ไขข้อมูลผู้ติดต่อ Mixed</h4>
                        <form action="process.php" method="post" enctype="multipart/form-data">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                        </form>
                    </div>
                    <div class="col mt-3 text-center">
                        <button class="btn btn-warning bg-gradient-purple" type="submit">
                            ตกลง
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="col">
                        <h4>แก้ไขข้อมูลผู้ติดต่อ FBH</h4>
                        <form action="process.php" method="post" enctype="multipart/form-data">
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="6"></textarea>
                        </form>
                    </div>
                    <div class="col mt-3 text-center">
                        <button class="btn btn-warning bg-gradient-purple" type="submit">
                            ตกลง
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
</script>