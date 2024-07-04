<form action="insert_register.php" id="insert_users" method="post">
    <!-- Begin Page Content -->
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h2 text-gray-900 mb-2">เพิ่มงาน</h1>
                        </div>
                        <hr class="user">
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input type="text" id="route" name="route" class="form-control form-control-user" placeholder="Route" required="" autofocus="">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" id="section" name="section" class="form-control form-control-user" placeholder="section" required="">
                            </div>
                            <div class="col-sm-4">
                                <input type="text" id="team" name="team" class="form-control form-control-user" placeholder="team" required="">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3">
                                <input type="number" id="cable_form" name="cable_form" class="form-control form-control-user" placeholder="Cable Form" required="">
                            </div>
                            <div class="col-sm-3">
                                <input type="number" id="cable_to" name="cable_to" class="form-control form-control-user" placeholder="Cable To" required="">
                            </div>
                            <div class="col-sm-3">
                                <input type="number" id="drum" name="drum" class="form-control form-control-user" placeholder="Drum" required="">
                            </div>
                            <div class="col-sm-3">
                                <input list="dataList" id="drum_cable_company" name="drum_cable_company" class="form-control" placeholder="รับจากบริษัท" required="">
                                <datalist id="dataList">
                                    <option value="Mixed"></option>
                                    <option value="FBH"></option>
                                </datalist>
                            </div>
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