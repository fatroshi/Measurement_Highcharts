<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="inputName">Titel:</label>
        <input type="text" name="name" class="form-control" id="inputName" placeholder="Titel...">
    </div>

    <div class="form-group">
        <label for="inputInfo">Information:</label>
        <textarea  class="form-control" rows="10" cols="50" name="info" placeholder="Information..." >

        </textarea>
    </div>

    <div class="form-group">
        <label for="exampleInputFile">Ladda upp fil</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        <p class="help-block">Endast .txt filer kan laddas upp.</p>
    </div>

    <button type="submit" class="btn btn-default" name="newProductBtn">Spara</button>
</form>