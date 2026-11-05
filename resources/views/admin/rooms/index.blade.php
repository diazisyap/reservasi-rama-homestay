@extends('layouts.admin')

@section('title', 'Kelola Kamar - Admin')
@section('page_title', 'Kelola Kamar')

@section('content')
<style>
    /* Card panel container */
    .table-card {
        background: #ffffff;
        border-radius: 20px;
        border: 1px solid #e2e8f0;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
    }
    
    .table-title-area {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }
    
    /* Modal container */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.45);
        backdrop-filter: blur(5px);
        z-index: 1000;
        align-items: center;
        justify-content: center;
        overflow-y: auto;
        padding: 20px;
    }
    
    .modal-container {
        background: #ffffff;
        border-radius: 24px;
        padding: 35px;
        width: 100%;
        max-width: 580px;
        margin: auto;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        border: 1px solid #e2e8f0;
        animation: modalFadeIn 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }
    
    @keyframes modalFadeIn {
        from { opacity: 0; transform: translateY(20px) scale(0.98); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
</style>

<div class="table-card">
    <div class="table-title-area">
        <h2 style="font-size: 1.4rem; font-weight: 800; color: #0f172a; margin: 0;">Daftar Kamar Homestay</h2>
        <button class="btn-admin-primary" onclick="document.getElementById('modal-add').style.display='flex'" style="display:inline-flex; align-items:center; gap:8px;">
            <i data-lucide="plus" style="width: 16px; height:16px;"></i>
            <span>Tambah Kamar Baru</span>
        </button>
    </div>
    
    <div class="table-wrapper" style="overflow-x:auto;">
        <table class="table" style="width:100%; border-collapse:collapse;">
            <thead>
                <tr style="border-bottom: 2px solid #f1f5f9; text-align: left;">
                    <th style="padding: 15px 10px; color:#64748b; font-weight:700; font-size:0.82rem; text-transform:uppercase; letter-spacing:1px;">Gambar</th>
                    <th style="padding: 15px 10px; color:#64748b; font-weight:700; font-size:0.82rem; text-transform:uppercase; letter-spacing:1px;">Kamar</th>
                    <th style="padding: 15px 10px; color:#64748b; font-weight:700; font-size:0.82rem; text-transform:uppercase; letter-spacing:1px;">Harga / Malam</th>
                    <th style="padding: 15px 10px; color:#64748b; font-weight:700; font-size:0.82rem; text-transform:uppercase; letter-spacing:1px;">Stok Unit</th>
                    <th style="padding: 15px 10px; color:#64748b; font-weight:700; font-size:0.82rem; text-transform:uppercase; letter-spacing:1px; text-align:right;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rooms as $room)
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 16px 10px;">
                            @if($room->image)
                                <div style="width: 65px; height: 65px; border-radius: 12px; background-image: url('{{ asset('storage/'.$room->image) }}'); background-size: cover; background-position: center; border: 1px solid #e2e8f0;"></div>
                            @else
                                <div style="width: 65px; height: 65px; border-radius: 12px; background: #f1f5f9; display:flex; align-items:center; justify-content:center; border: 1px dashed #cbd5e1;">
                                    <i data-lucide="image" style="width: 22px; height: 22px; color: #94a3b8;"></i>
                                </div>
                            @endif
                        </td>
                        <td style="padding: 16px 10px; vertical-align: middle;">
                            <strong style="font-size:1rem; color:#0f172a; display:block;">{{ $room->name }}</strong>
                            <span style="font-size:0.85rem; color:#64748b;">{{ Str::limit($room->description, 75) }}</span>
                        </td>
                        <td style="padding: 16px 10px; vertical-align: middle; color:#0f172a; font-weight:700; font-size:0.95rem;">
                            Rp {{ number_format($room->price, 0, ',', '.') }}
                        </td>
                        <td style="padding: 16px 10px; vertical-align: middle; color:#334155; font-weight:600; font-size:0.95rem;">
                            {{ $room->total_rooms }} Unit
                        </td>
                        <td style="padding: 16px 10px; vertical-align: middle; text-align:right;">
                            <div style="display:flex; gap:8px; justify-content:flex-end;">
                                <button class="btn btn-outline" style="padding: 8px 16px; border-radius:8px; font-size: 0.85rem; font-weight:700;" onclick="document.getElementById('modal-edit-{{ $room->id }}').style.display='flex'">Edit</button>
                                <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kamar ini? Tindakan ini tidak bisa dibatalkan.');" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn" style="padding: 8px 16px; border-radius:8px; font-size: 0.85rem; font-weight:700; background: #fee2e2; color: #dc2626; border: none; cursor:pointer;">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div id="modal-edit-{{ $room->id }}" class="modal-overlay">
                        <div class="modal-container">
                            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px; border-bottom:1px solid #f1f5f9; padding-bottom:15px;">
                                <h3 style="margin:0; font-size:1.25rem; font-weight:800; color:#0f172a;">Edit Detail Kamar</h3>
                                <button type="button" onclick="document.getElementById('modal-edit-{{ $room->id }}').style.display='none'" style="background:none; border:none; color:#94a3b8; cursor:pointer;"><i data-lucide="x" style="width:20px; height:20px;"></i></button>
                            </div>
                            
                            <form method="POST" action="{{ route('admin.rooms.update', $room) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group" style="margin-bottom:15px;">
                                    <label class="form-label" style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:6px;">NAMA KAMAR</label>
                                    <input type="text" name="name" class="form-control" value="{{ $room->name }}" style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:8px;" required>
                                </div>
                                <div class="form-group" style="margin-bottom:15px;">
                                    <label class="form-label" style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:6px;">DESKRIPSI KAMAR</label>
                                    <textarea name="description" class="form-control" rows="4" style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:8px; resize:none;" required>{{ $room->description }}</textarea>
                                </div>
                                <div style="display:flex; gap:15px; margin-bottom:15px;">
                                    <div class="form-group" style="flex:1;">
                                        <label class="form-label" style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:6px;">HARGA SEWA (RP / MALAM)</label>
                                        <input type="number" name="price" class="form-control" value="{{ (int)$room->price }}" style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:8px;" required>
                                    </div>
                                    <div class="form-group" style="flex:1;">
                                        <label class="form-label" style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:6px;">JUMLAH STOK KAMAR</label>
                                        <input type="number" name="total_rooms" class="form-control" value="{{ $room->total_rooms }}" style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:8px;" required>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom:15px;">
                                    <label class="form-label" style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:6px;">FOTO KAMAR (FORMAT JPG/PNG, MAX 2MB)</label>
                                    <input type="file" name="image" class="form-control" accept="image/*" style="width:100%; padding:8px 0;">
                                    <small style="color:#94a3b8; font-size:0.75rem; margin-top:5px; display:block;">Biarkan kosong jika tidak ingin mengganti foto yang sudah ada.</small>
                                </div>
                                
                                <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:25px; border-top:1px solid #f1f5f9; padding-top:15px;">
                                    <button type="button" class="btn btn-outline" onclick="document.getElementById('modal-edit-{{ $room->id }}').style.display='none'" style="border-radius:8px; padding:10px 18px; border:1px solid #cbd5e1; background:#fff; cursor:pointer;">Batal</button>
                                    <button type="submit" class="btn btn-primary" style="border-radius:8px; padding:10px 20px; color:white; background:var(--primary); border:none; font-weight:700; cursor:pointer;">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Add Modal -->
<div id="modal-add" class="modal-overlay">
    <div class="modal-container">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 20px; border-bottom:1px solid #f1f5f9; padding-bottom:15px;">
            <h3 style="margin:0; font-size:1.25rem; font-weight:800; color:#0f172a;">Tambah Kamar Baru</h3>
            <button type="button" onclick="document.getElementById('modal-add').style.display='none'" style="background:none; border:none; color:#94a3b8; cursor:pointer;"><i data-lucide="x" style="width:20px; height:20px;"></i></button>
        </div>
        
        <form method="POST" action="{{ route('admin.rooms.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group" style="margin-bottom:15px;">
                <label class="form-label" style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:6px;">NAMA KAMAR</label>
                <input type="text" name="name" class="form-control" placeholder="Contoh: Kamar 9" style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:8px;" required>
            </div>
            <div class="form-group" style="margin-bottom:15px;">
                <label class="form-label" style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:6px;">DESKRIPSI KAMAR</label>
                <textarea name="description" class="form-control" rows="4" style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:8px; resize:none;" placeholder="Tuliskan spesifikasi kamar dan kelengkapan kasur/interior..." required></textarea>
            </div>
            <div style="display:flex; gap:15px; margin-bottom:15px;">
                <div class="form-group" style="flex:1;">
                    <label class="form-label" style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:6px;">HARGA SEWA (RP / MALAM)</label>
                    <input type="number" name="price" class="form-control" placeholder="300000" style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:8px;" required>
                </div>
                <div class="form-group" style="flex:1;">
                    <label class="form-label" style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:6px;">JUMLAH STOK KAMAR</label>
                    <input type="number" name="total_rooms" class="form-control" value="1" style="width:100%; padding:10px 14px; border:1px solid #cbd5e1; border-radius:8px;" required>
                </div>
            </div>
            <div class="form-group" style="margin-bottom:15px;">
                <label class="form-label" style="font-size:0.75rem; letter-spacing:1px; font-weight:700; color:#475569; display:block; margin-bottom:6px;">UPLOAD FOTO KAMAR</label>
                <input type="file" name="image" class="form-control" accept="image/*" style="width:100%; padding:8px 0;" required>
            </div>
            
            <div style="display:flex; justify-content:flex-end; gap:12px; margin-top:25px; border-top:1px solid #f1f5f9; padding-top:15px;">
                <button type="button" class="btn btn-outline" onclick="document.getElementById('modal-add').style.display='none'" style="border-radius:8px; padding:10px 18px; border:1px solid #cbd5e1; background:#fff; cursor:pointer;">Batal</button>
                <button type="submit" class="btn btn-primary" style="border-radius:8px; padding:10px 20px; color:white; background:var(--primary); border:none; font-weight:700; cursor:pointer;">Simpan Kamar</button>
            </div>
        </form>
    </div>
</div>
@endsection
