<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-4">
        <h3>Detail Produk: {{ $product->name }}</h3>

        <p><strong>Kategori:</strong> {{ $product->category->name ?? '-' }}</p>
        <p><strong>Supplier:</strong> {{ $product->supplier->name ?? '-' }}</p>
        <p><strong>Harga:</strong> {{ $product->price }}</p>

        <hr>
        <h4>Audit Trail</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>User</th>
                    <th>Changes</th>
                    <th>Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($product->audits as $audit)
                <tr>
                    <td>{{ ucfirst($audit->event) }}</td>
                    <td>{{ $audit->user->name ?? 'System' }}</td>
                    <td>
                        <pre>{{ json_encode($audit->getModified(), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                    </td>
                    <td>{{ $audit->created_at->timezone('Asia/Jakarta')->format('d-m-Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Belum ada audit</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>

</html>
