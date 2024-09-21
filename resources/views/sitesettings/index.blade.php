<form action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div>
        <label for="header_logo">Header Logo</label>
        <input type="file" name="image" id="header_logo">
    </div>
    <div>
        <label for="footer">Footer</label>
        <input type="text" name="footer" id="footer">
    </div>
    <div>
        <label for="contact">Contact Number</label>
        <input type="text" name="contact" id="contact">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="slogan">Slogan</label>
        <input type="text" name="slogan" id="slogan">
    </div>
    <button type="submit">Submit</button>
</form>
