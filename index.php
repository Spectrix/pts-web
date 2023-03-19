<?php 
include 'header.php'; 
include 'config.php';
?>
<!-- button triger -->
<button type=" button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#tambahEcommerce">Tambah Ecommerce</button>
<!-- button triger -->
<!-- DataTales Example -->
<div class="card shadow mb-4">
	<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Ecommerce</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<!-- Tabel data untuk menanmpilkan data hasil query database beserta tombol edit dan delete-->
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr class="text-center">
                        <th width="200">No</th>
                        <th>Id</th>
                        <th>Sku</th>
						<th>Name</th>
						<th>Price</th>
						<th>Category</th>
						<th>Stock</th>
                        <th width="100">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $no = 1;
                    $query = "SELECT * FROM products";
                    $exec = mysqli_query($db, $query);
                    while ($res = mysqli_fetch_assoc($exec)): ?>
                    <tr>

                        <td class="text-center"><?= $no++ ?>
                        </td>
                        <td>
                            <?= $res["id"] ?>
                        </td>
                        <td>
                            <?= $res["sku"] ?>
                        </td>
						<td>
                            <?= $res["name"] ?>
                        </td>
						<td>
                            <?= $res["price"] ?>
                        </td>
						<td>
                            <?= $res["category"] ?>
                        </td>
						<td>
                            <?= $res["stock"] ?>
                        </td>
						
                        <td class="text-center">
                            <div class="btn-group mr-2" role="group" aria-label="Action group button">
                                <a href="#" class="view_data btn btn-sm btn-warning" data-toggle="modal"
                                    data-target="#editEcommerce" id="<?php echo $res["id"]; ?>">Update</a>
                                <a href="index.php?id=<?= $res["id"] ?>"
                                    class="btn btn-sm btn-danger"
                                    onclick="return Confirm('Apakah Yakin ingin Menghapus data?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile;
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<!-- Modal untuk tambah data-->
<div class="modal fade" id="tambahEcommerce" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Data Ecommerce</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  <form action="index.php" method="POST">
                    <input type="text" name="id" placeholder="Id" class="form-control mb-2">
                    <input type="text" name="sku" placeholder="Sku" class="form-control mb-2">
					<input type="text" name="name" placeholder="Name" class="form-control mb-2">
					<input type="text" name="price" placeholder="Price" class="form-control mb-2">
					<input type="text" name="category" placeholder="Category" class="form-control mb-2">
					<input type="text" name="stock" placeholder="Stock" class="form-control mb-2">
                    <div class="modal-footer">
                        <button type="button" onClick="self.history.back()" class="btn btn-secondary" data-bs-
                            dismiss="modal">Batal</button> <button type="submit" name="simpan"
                            class="btn btn-primary">Simpan</button>
                    </div>
                </form>	
			</div>
    </div>
  </div>
</div>

<!-- Modal untuk edit data-->
<div class="modal fade" id="editEcommerce" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Data Ecommerce</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="dataEcommerce">
				<!-- form edit data dipisah ke dalam file view.php -->
			</div>
    </div>
  </div>
</div>

<script type="text/javascript">
    $('.view_data').click(function () {
        var id= $(this).attr('id');
        $.ajax({
            url: 'view.php',
            method: 'POST',
            data: { id: id },
            success: function (data) {
                $('#dataEcommerce').html(data)
                $('#editEcommerce').modal('show')
            }
        })
    })
//script ajax
</script>

<?php 
//Proses tambah data ke dalam tabel database
if (isset($_POST["simpan"])) {
    $nik = htmlentities(
    strip_tags(strtoupper($_POST["id"]))
    );
    $id = htmlentities(strip_tags(strtoupper($_POST["id"])));
    $sku = htmlentities(strip_tags(strtoupper($_POST["sku"])));
    $name= htmlentities(strip_tags(strtoupper($_POST["name"])));
    $price = htmlentities(strip_tags(strtoupper($_POST["price"])));
    $category = htmlentities(strip_tags(strtoupper($_POST["category"])));
    $stock = htmlentities(strip_tags(strtoupper($_POST["stock"])));
    $query = "INSERT INTO products (id,sku,name,price,category,stock) VALUES ('$id', '$sku','$name','$price','$category','$stock')";
    $exec = mysqli_query($db, $query);
    if ($exec) {
        echo "<script>alert('data Ecommerce berhasil disimpan') 
document.location = 'index.php';</script>";
    } else {
        echo "<script>alert('data Ecommerce gagal disimpan')
    document.location = 'index.php';</script>";
    }
}

//Proses hapus data pada tabel database
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $exec = mysqli_query(
        $db,
        "DELETE FROM products WHERE id='$id' "
    );
    if ($exec) {
        echo "<script>alert('data Ecommerce berhasil dihapus')
                document.location = 'index.php';</script>";
    } else {
        echo "<script>alert('data Ecommerce gagal dihapus')
                document.location = 'index.php';</script>";
    }
}

//Proses update data pada tabel database
if (isset($_POST["Update"])) {
    $id = $_POST["id"];
    $sku = htmlentities(strip_tags(strtoupper($_POST["sku"])));
    $name = htmlentities(strip_tags(strtoupper($_POST["name"])));
    $price= htmlentities(strip_tags(strtoupper($_POST["price"])));
    $category = htmlentities(strip_tags(strtoupper($_POST["category"])));
    $stock = htmlentities(strip_tags(strtoupper($_POST["stock"])));
    $query = "UPDATE products SET sku = '$sku',name = '$name',price= '$price',category = '$category',stock = '$stock' WHERE id='$id'";
    $exec = mysqli_query($db, $query);
    if ($exec) {
        echo "<script>alert('data Ecommerce berhasil diedit')
                document.location = 'index.php'</script>;";
    } else {
        echo "<script>alert('data Ecommerce gagal diedit')
                        document.location = 'index.php' </script>";
    }
}
?>