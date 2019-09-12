[Fesban Gebyar Muharram]({{url('/')}})

# Salam! {{$grup->name}}

Selamat, Grup Anda telah terdaftar pada lomba festival banjari Gebyar Muharram tahun {{date('Y')}}. Berikut kami kirimkan QRCode (terlampir dalam bentuk file pdf) untuk melakukan registrasi kehadiran. Registrasi Kehadiran tidak boleh melebihi pukul 14:40.

Grup ID : {{$grup->grup_number}}

Gunakan QRCode ini untuk melakukan registrasi kehadiran, pengambilan snack dan photobooth.

Nomor Urut : {{$grup->event_packs[0]->nomor_urut}}
Username : {{$grup->user->email}}
Password : fesbangm2019

Segera Lakukan Penggantian Password ketika sudah login ke dalam sistem. Jika ada pertanyaan silahkan hubungi contact person panitia festival banjari Gebyar Muharram.

Salam Hangat,
Panitia Fesban Gebyar Muharram

Jika terdapat masalah pada saat melakukan pemindaian gunakan nomor id ini : 
{{$grup->grup_number}}

© 2019 Fesban Gebyar Muharram. All rights reserved.