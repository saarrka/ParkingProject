<x-app-layout>
    <div class="container manage-categories">
        <h1>Manage Categories</h1>

        {{-- Prikaz poruka o uspehu --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Forma za dodavanje nove kategorije --}}
        <form action="{{ route('categories.store') }}" class="categories-form" method="POST">
            @csrf
            <div class="form-group">
                <label for="vehicle_cat">New Category</label>
                <input type="text" name="vehicle_cat" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary mt-3 add-button">Add Category</button>
        </form>

        {{-- Lista postojećih kategorija --}}
        <h2 style="margin: 80px 0 20px;">Categories</h2>
        <ul class="list-group">
            @foreach ($categories as $category)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{-- Redni broj i ime kategorije --}}
                    <span>
                        {{ $loop->iteration }}. {{ $category->vehicle_cat }}
                    </span>
        
                    {{-- Dugmići za Edit i Delete --}}
                    <span>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
        
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirmDelete('{{ $category->vehicle_cat }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </span>
                </li>
            @endforeach
        </ul>
        
        <script>
            function confirmDelete(categoryName) {
                return confirm('Are you sure you want to delete "' + categoryName + '"?');
            }
        </script>
    </div>
   
</x-app-layout>

