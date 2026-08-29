Apa perbedaan Model, View, dan Controller menurut pemahaman sendiri. 

-  View (Buku Menu & Piring Saji)
Tugasnya murni urusan visual yang dilihat pengunjung. Nggak usah pusing mikirin bumbu dapur atau stok beras di gudang, tugasnya cuma nyajiin makanan yang udah matang ke meja biar kelihatan enak. Gak boleh ngitung sama jalananin query, hanya boleh menyajikan data matang.
 
- Model (Dapur & Stok Gudang)
Bagian yang megang data mentah dan aturan mainnya. Cuma dapur yang tahu takaran resep, isi rak bahan, dan cara ngolah bahan baku dari database. Model bertugas menguaaarus data mentah dan aturan bisnis yang terhubung langsung ke database. Tahu struktur tabel serta cara mengambil, mengedit, atau menghapus data. Tempat ubah logika query atau relasi antar tabel...

- Controller (Pelayan/Waiter)
Penghubung serba bisa. Pas kamu manggil buat pesen es teh manis (kirim request), pelayan bakal lari ke dapur (Model) buat minta dibuatin, terus nganterin gelasnya ke meja kamu (View). Pokoknya jembatan setiap pengguna, kayak lalu lintas

Intinya, arsitektur MVC dibikin biar kodingan nggak numpuk jadi spaghetti code di satu file. Jadi pas frontend mau ganti warna tombol, cukup bongkar file View tanpa takut ngerusak query database di Model.