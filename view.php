<?php include 'config.php';

if(isset($_POST['id'])) {
$id = $_POST['id'];
$exec = mysqli_query($db,"SELECT * FROM products WHERE id = '$id' ");
$res = mysqli_fetch_assoc($exec);
?>
<form action="index.php" method="POST">
    <div class="form-group">
        <input type="hidden" class="form-control" name="id" value="<?=$res['id'] ?>">
    </div>
    <div class="form-group">
        <label>Sku</label>    
        <input type="text" class="form-control" name="sku" value="<?=$res['sku'] ?>">
    </div>
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name" value="<?=$res['name'] ?>">
    </div>
    <div class="form-group">
    <label>Price</label> 
        <input type="text" class="form-control" name="price" value="<?=$res['price'] ?>">
    </div>
    <div class="form-group">
        <label>Category</label>    
        <input type="text" class="form-control" name="category" value="<?=$res['category'] ?>">
    </div>
    <div class="form-group">
        <label>Stock</label>
        <input type="text" class="form-control" name="stock" value="<?=$res['stock'] ?>">
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>   
    <button type="Submit" name="Update" class="btn btn-warning">Update</button>
    </div>
</form>
<?php } 