<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0 text-dark">Tambahkan Post</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ url('toko') }}">Home</a></li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="<?= site_url('admin/post/simpan') ?>" method="post" enctype="multipart/form-data">
                        
                <?=
                    form::input([
                        "title" => "No Post",
                        "type" => "text",
                        "fc" => "no_post",
                        "placeholder" => "tambahkan no_post",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "Judul",
                        "type" => "text",
                        "fc" => "judul",
                        "placeholder" => "tambahkan judul",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "Slug",
                        "type" => "text",
                        "fc" => "slug",
                        "placeholder" => "tambahkan slug",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "Kategori",
                        "type" => "text",
                        "fc" => "kategori",
                        "placeholder" => "tambahkan kategori",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "Thumbnails",
                        "type" => "text",
                        "fc" => "thumbnails",
                        "placeholder" => "tambahkan thumbnails",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "Tanggal",
                        "type" => "text",
                        "fc" => "tanggal",
                        "placeholder" => "tambahkan tanggal",
                    ])
                ?>
            
                <?=
                    form::input([
                        "title" => "Tag",
                        "type" => "text",
                        "fc" => "tag",
                        "placeholder" => "tambahkan tag",
                    ])
                ?>
            
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary">Simpan</button>
                          <a class="btn btn-default" href="<?= site_url('admin/post'); ?>">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
      </div>
    </section>
</div>