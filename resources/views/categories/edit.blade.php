<x-app-layout>
    <div class="container manage-categories">
        <h1 style="margin-top: 20px;">Edit Category</h1>

        {{-- Forma za izmenu postojeće kategorije --}}
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="vehicle_cat"></label>
                <input type="text" name="vehicle_cat" value="{{ $category->vehicle_cat }}" class="form-control" required>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Update Category</button>
                <a href="{{ route('categories.index') }}" class="btn btn-danger">Back</a> {{-- Dugme za povratak na listu kategorija --}}
            </div>
        </form>
    </div>
</x-app-layout>
