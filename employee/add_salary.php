<form action="users/insert_users_process.php" id="insert_users" method="post">
    <!-- Begin Page Content -->
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h2 text-gray-900 mb-2">เพิ่มเงินเดือน</h1>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <h4>ชื่อ</h4>
                                <input type="text" id="name" name="name" class="form-control form-control-user" placeholder="ชื่อ" required="">
                            </div>
                            <div class="col-sm-6">
                                <h4>นามสกุล</h4>
                                <input type="text" id="lastname" name="lastname" class="form-control form-control-user" placeholder="นามสกุล" required="">
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <h4>เงินเดือน</h4>
                                <input type="number" id="salary" name="salary" class="form-control form-control-user" placeholder="เงินเดือน" required="">
                            </div>
                            <div class="col-sm-2">
                                <h4>อายุ</h4>
                                <input type="number" id="age" name="age" class="form-control form-control-user" placeholder="อายุ" required="">
                            </div>
                            <div class="col-sm-3">
                                <h4>อีเมล</h4>
                                <input type="email" id="email" name="email" class="form-control form-control-user" placeholder="อีแมล" required="">
                            </div>
                            <div class="col-sm-3">
                                <h4>เบอร์โทร</h4>
                                <input type="text" id="phone" name="phone" class="form-control form-control-user" placeholder="เบอร์โทร" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <h4>เลือกตำแหน่ง</h4>
                            <select class="form-control col-3" id="type" name="type">
                                <option value="0">แอดมิน</option>
                                <option value="1">เจ้าของบริษัท</option>
                                <option value="2">พนักงานเอกสาร</option>
                                <option value="3">พนักงานปฏิบัติงาน</option>
                            </select>
                        </div>
                        <button class="btn btn-warning bg-gradient-purple btn-user btn-block col-sm-3 container" id="insert_users" type="submit">
                            <h5>เพิ่มข้อมูล</h5>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>