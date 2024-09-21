<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale: 1.0">
    <title>Edit Product</title>
</head>
<body>
    
<!-- navbar -->
@include('backend.common.navbar')
<!-- end navbar -->

<!-- sidebar -->
@include('backend.common.sidebar')
<!-- end sidebar -->

<div style="display: flex; flex-direction: column; height: 100vh; margin-top: 50px;">
    <div style="flex: 1; display: flex;">
        <div style="flex: 0 0 auto; width: 250px;">
            <!-- Sidebar content goes here -->
        </div>
        <div style="flex: 1; padding: 20px; overflow-y: auto;">

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div style="background-color: #fff; border-radius: 8px; padding: 20px;">
                <div style="margin-bottom: 20px;">
                    <h4 style="margin: 0;">Edit Product</h4>
                    <h6 style="margin: 0;">Update Existing Product Details</h6>
                </div>

                <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div style="margin-top: 20px;">
                        <div style="display: flex; flex-wrap: wrap;">
                            <div style="flex: 1 1 25%; padding: 10px;">
                                <label>Product Name</label>
                                <input type="text" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="name" value="{{ $product->name }}" required>
                            </div>

                            <div style="flex: 1 1 25%; padding: 10px;">
                                <label>Category</label>
                                <select style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="category" required>
                                    <option value="">Choose Category</option>
                                    <option value="Girls/Womens" {{ $product->category == 'Girls/Womens' ? 'selected' : '' }}>Girls/Womens</option>
                                    <option value="Boys/Adults" {{ $product->category == 'Boys/Adults' ? 'selected' : '' }}>Boys/Adults</option>
                                    <option value="Accessories" {{ $product->category == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                                </select>
                            </div>

                            <div style="flex: 1 1 25%; padding: 10px;">
                                <label>SKU</label>
                                <input type="text" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="sku" value="{{ $product->sku }}" required>
                            </div>
                            <div style="flex: 1 1 25%; padding: 10px;">
                                <label>Quantity</label>
                                <input type="number" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="qty" value="{{ $product->qty }}" required>
                            </div>
                            <div style="flex: 1 1 100%; padding: 10px;">
                                <label>Description</label>
                                <textarea style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="description" required>{{ $product->description }}</textarea>
                            </div>
                            <div style="flex: 1 1 25%; padding: 10px;">
                                <label>Price</label>
                                <input type="text" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;" name="price" value="{{ $product->price }}" required>
                            </div>

                            <!-- images -->
                            <div style="flex: 1 1 100%; padding: 10px;">
    <label>Current Product Image</label>
    <div style="margin-bottom: 10px;">
        @if($product->image && file_exists(public_path('uploads/' . $product->image)))
            <img src="{{ asset('uploads/' . $product->image) }}" alt="Current Image" style="max-width: 150px; border: 1px solid #ccc; border-radius: 4px;">
        @else
            <p>No image available</p>
        @endif
    </div>
    <label>Upload New Image (optional)</label>
    <div id="dropArea" style="position: relative; border: 2px dashed #ccc; padding: 20px; text-align: center;">
        <input type="file" id="fileInput" name="image" style="display: none;" onchange="updateFileName()">
        <img src="{{ asset('assets/img/icons/upload.svg') }}" alt="Upload" style="max-width: 50px; margin-bottom: 10px;">
        <h4 style="margin: 0;">Drag and drop a file to upload</h4>
        <div id="fileName" style="margin-top: 10px; font-weight: bold;">No file chosen.</div>
    </div>
</div>
   <!-- images end -->

                            <div style="flex: 1 1 100%; padding: 10px;">
                                <button type="submit" class="btn btn-submit" style="padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 4px;">Update</button>
                                <a href="{{ route('products.index') }}" class="btn btn-cancel" style="padding: 10px 20px; background-color: #ccc; color: #333; border: none; border-radius: 4px; text-decoration: none;">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- current image showing js -->
<script>
    const fileInput = document.getElementById('fileInput');
    const fileNameDisplay = document.getElementById('fileName');

    document.getElementById('dropArea').addEventListener('click', () => fileInput.click());

    function updateFileName() {
        const files = fileInput.files;
        if (files.length > 0) {
            fileNameDisplay.textContent = `File: ${files[0].name}`;
        } else {
            fileNameDisplay.textContent = 'No file chosen.';
        }
    }
</script>
 <!-- end js  -->





<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('.alert-dismissible .close').click(function() {
            $(this).parent('.alert').fadeOut();
        });
    });
</script>

<script>
    const dropArea = document.getElementById('dropArea');
    const fileInput = document.getElementById('fileInput');
    const fileNameDisplay = document.getElementById('fileName');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);  
        document.body.addEventListener(eventName, preventDefaults, false);  
    });

    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    dropArea.addEventListener('drop', handleDrop, false);
    dropArea.addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', handleFiles, false);

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function highlight() {
        dropArea.style.borderColor = '#000';
    }

    function unhighlight() {
        dropArea.style.borderColor = '#ccc';
    }

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const files = dt.files;
        handleFiles(files);
    }

    function handleFiles(files) {
        if (files.length > 0) {
            const file = files[0];
            fileNameDisplay.textContent = `File: ${file.name}`;
            fileInput.files = files; 
        } else {
            fileNameDisplay.textContent = 'No file chosen.';
        }
    }

    fileInput.addEventListener('change', (event) => {
        const files = event.target.files;
        handleFiles(files);
    });
</script>

</body>
</html>
