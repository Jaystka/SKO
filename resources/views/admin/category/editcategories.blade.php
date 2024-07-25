@extends('../layout/sidebar')

@section('head')
<title>Edit Category - SKO</title>
@endsection

@section('content')
<main class="flex-1 overflow-y-auto px-8 pb-6">
    <div class="mb-4 pt-4">
        <h1 class="text-xl font-MadeTomy-Medium text-[#3C4043]">Edit Category</h1>
    </div>
    <div class="max-w-full mx-auto bg-[#F8F7F3] px-8 py-4 rounded-xl shadow-lg">
        <form id="editcategory" action="{{ route('admin.category.update', ['id' => $category->category_id]) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4 flex items-center">
                <label for="category" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Category:</label>
                <input type="text" id="category" name="category" value="{{ $category->category }}" class="w-11/12 p-2 border border-gray-300 rounded-lg bg-[#F8F7F3]" required>
            </div>
            <div class="mb-4 flex items-center">
                <label for="category_desc" class="block text-[#3C4043] font-MadeTomy-Regular w-32">Description:</label>
                <input type="text" id="category_desc" name="category_desc" value="{{ $category->category_desc }}" class="w-11/12 p-2 border border-gray-300 rounded-lg bg-[#F8F7F3]" required>
            </div>
            <div class="flex justify-end space-x-4">
                <a type="button" href="{{ route('category') }}" class="bg-[#B90000] text-white py-3 px-6 rounded-lg hover:bg-red-600 text-sm">Cancel</a>
                <button type="submit" class="bg-[#187900] text-white py-3 px-7 rounded-lg hover:bg-green-600 text-sm">Update</button>
            </div>
        </form>
    </div>
</main>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    // Function to handle form submission with confirmation
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('editcategory').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the form from submitting immediately

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to save the changes?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, save changes!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if user confirms
                    e.target.submit();
                }
            });
        });
    });

</script>
@endsection