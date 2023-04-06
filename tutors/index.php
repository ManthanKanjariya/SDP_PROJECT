<style>
    .carousel-item>img {
        object-fit: cover !important;
    }

    #carouselExampleControls .carousel-inner {
        height: 18em !important;
    }

    #search-field .form-control.rounded-pill {
        border-top-right-radius: 0 !important;
        border-bottom-right-radius: 0 !important;
        border-right: none !important
    }

    #search-field .form-control:focus {
        box-shadow: none !important;
    }

    #search-field .form-control:focus+.input-group-append .input-group-text {
        border-color: #86b7fe !important
    }

    #search-field .input-group-text.rounded-pill {
        border-top-left-radius: 0 !important;
        border-bottom-left-radius: 0 !important;
        border-right: left !important
    }

    .post-item {
        transition: all .2s ease-in-out;
    }

    .post-item:hover {
        transform: scale(1.02);
    }

    .tutor-avatar {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center center;
    }
</style>
<section class="py-3">
    <div class="container">

        <div class="row justify-content-center mt-n3">
            <div class="col-lg-11 col-md-11 col-sm-12 col-sm-12">
                <div class="card card-outline rounded-0">
                    <div class="card-body">
                        <div class="container-fluid">
                            <form action="" id="search-form">
                                <div class="row justify-content-center mb-4">
                                    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
                                        <div class="input-group input-group-lg" id="search-field">
                                            <input type="search" class="form-control form-control-lg  rounded-pill" aria-label="Search Post Input" id="search" name="search" placeholder="Search here" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text rounded-pill bg-transparent"><i class="fa fa-search"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="clear-fix my-2"></div>
                            <div class="row row-cols-xl-2 row-cols-md-2 row-cols-sm-1 gx-2 gy-1">
                                <?php
                                $additional_fields = "";
                                $additional_field[] = "COALESCE((SELECT meta_value FROM `tutor_meta` where tutor_id = tutor_list.id and meta_field = 'contact'),'') as contact";
                                $additional_field[] = "COALESCE((SELECT meta_value FROM `tutor_meta` where tutor_id = tutor_list.id and meta_field = 'address'),'') as address";
                                $additional_field[] = "COALESCE((SELECT meta_value FROM `tutor_meta` where tutor_id = tutor_list.id and meta_field = 'gender'),'') as gender";
                                $additional_field[] = "COALESCE((SELECT meta_value FROM `tutor_meta` where tutor_id = tutor_list.id and meta_field = 'specialty'),'') as specialty";
                                if (count($additional_field) > 0) {
                                    $additional_fields = implode(", ", $additional_field);
                                }
                                $swhere = '';
                                if (isset($_GET['search']) && !empty($_GET['search'])) {
                                    $search = $_GET['search'];
                                    $swhere .= " CONCAT(lastname , firstname , COALESCE(concat(' ', middlename), '')) LIKE '%{$search}%' ";
                                    $swhere .= " or `email` LIKE '%{$search}%' ";
                                    $swhere .= " or COALESCE((SELECT meta_value FROM `tutor_meta` where tutor_id = tutor_list.id and meta_field = 'contact'),'') LIKE '%{$search}%' ";
                                    $swhere .= " or COALESCE((SELECT meta_value FROM `tutor_meta` where tutor_id = tutor_list.id and meta_field = 'address'),'') LIKE '%{$search}%' ";
                                    $swhere .= " or COALESCE((SELECT meta_value FROM `tutor_meta` where tutor_id = tutor_list.id and meta_field = 'specialty'),'') LIKE '%{$search}%' ";
                                    $swhere = "and ($swhere)";
                                }
                                if (!empty($additional_fields))
                                    $additional_fields = ", " . $additional_fields;
                                $tutors = $conn->query("SELECT *, CONCAT(lastname,', ',firstname , COALESCE(concat(' ', middlename), '')) as `name`{$additional_fields} FROM `tutor_list` where delete_flag = 0 and `status` = 1 {$swhere} ");
                                while ($row = $tutors->fetch_assoc()) :
                                ?>
                                    <div class="col">
                                        <div class="rounded-0 shadow row px-0  mx-0 bg-gradient-light border ">
                                            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 p-0">
                                                <img src="img\profile.jpg" alt="" class="h-100 tutor-avatar rounded-0">
                                            </div>
                                            <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 p-0 text-sm">
                                                <div class="d-flex w-100">
                                                    <div class="col-3 m-0 border px-2 py-1">Name</div>
                                                    <div class="col-9 m-0 border px-2 py-1"><?= $row['name'] ?></div>
                                                </div>
                                                <div class="d-flex w-100">
                                                    <div class="col-3 m-0 border px-2 py-1">Gender</div>
                                                    <div class="col-9 m-0 border px-2 py-1"><?= $row['gender'] ?></div>
                                                </div>
                                                <div class="d-flex w-100">
                                                    <div class="col-3 m-0 border px-2 py-1">Email</div>
                                                    <div class="col-9 m-0 border px-2 py-1"><?= $row['email'] ?></div>
                                                </div>
                                                <div class="d-flex w-100">
                                                    <div class="col-3 m-0 border px-2 py-1">Contact</div>
                                                    <div class="col-9 m-0 border px-2 py-1"><?= $row['contact'] ?></div>
                                                </div>
                                                <div class="d-flex w-100">
                                                    <div class="col-3 m-0 border px-2 py-1">Specialty</div>
                                                    <div class="col-9 m-0 border px-2 py-1 truncate-2"><?= $row['specialty'] ?></div>
                                                </div>
                                                <div class="my-1 text-center">
                                                    <a class="btn btn-sm rounded-pill px-3 btn-primary bg-gradient-primary" href="./?p=tutors/view_tutor&id=<?= $row['id'] ?>"><i class="fa fa-eye"></i> View Details</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    $(function() {
        $('#search-form').submit(function(e) {
            e.preventDefault()
            location.href = './?p=tutors&' + $(this).serialize()
        })
    })
</script>