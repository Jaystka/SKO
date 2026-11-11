@extends('layout.main')

@section('head')
<title>Edit Profile - SKO</title>
@endsection

@section('content')
<section class="flex items-center justify-center py-12 min-h-screen">
  <div class="p-6 md:p-12 rounded-lg max-w-4xl w-full mx-4 pt-24">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div class="flex flex-col items-center justify-around shadow-2xl rounded-3xl p-6">
        <img src="{{ $customer->avatar_url }}" alt="Foto profil" class="w-72 aspect-square rounded-full shadow-md">
      </div>
      <form class="formEdit" action="{{ route('editprofile.update') }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-y-8">
          <h2 class="text-2xl bodycopy font-medium mb-4">Profile</h2>
          <div>
            <div class="flex gap-x-4 items-center">
              <label for="username" class="bodycopy text-base w-1/4">Username</label>
              <input type="text" id="username" name="username" class="p-2 border rounded-md w-3/4" maxlength="255"
                value="{{ old('username', $customer->username) }}" required>
            </div>
            <p class="sko-field-error text-right" data-error-for="username"></p>
          </div>
          <div>
            <div class="flex gap-x-4 items-center">
              <label for="name" class="bodycopy text-base w-1/4">Nama</label>
              <input type="text" id="name" name="name" class="p-2 border rounded-md w-3/4" maxlength="255"
                value="{{ old('name', $customer->name) }}" autocomplete="name">
            </div>
            <p class="sko-field-error text-right" data-error-for="name"></p>
          </div>
          <div class="flex gap-x-4 items-center">
            <label for="email" class="bodycopy text-base w-1/4">Email</label>
            <input type="email" disabled id="email" class="p-2 border rounded-md w-3/4" value="{{ $customer->email }}">
          </div>
          <div>
            <div class="flex gap-x-4 items-center">
              <label for="phone" class="bodycopy text-base w-1/4">Phone</label>
              <input type="tel" id="phone" name="phone" class="p-2 border rounded-md w-3/4" maxlength="20" inputmode="tel"
                value="{{ old('phone', $customer->phone) }}" placeholder="08xxxxxxxxxx" autocomplete="tel">
            </div>
            <p class="sko-field-error text-right" data-error-for="phone"></p>
          </div>
          <div>
            <div class="flex gap-x-4 items-center">
              <label for="address" class="bodycopy text-base w-1/4">Address</label>
              <textarea id="address" name="address" class="p-2 border rounded-md w-3/4" rows="3"
                maxlength="1000">{{ old('address', $customer->address) }}</textarea>
            </div>
            <p class="sko-field-error text-right" data-error-for="address"></p>
          </div>
          <div class="flex justify-end gap-4 mt-4">
            <a href="{{ route('profileView') }}"
              class="py-5 px-10 border-2 border-gray-400 hover:border-black text-gray-500 hover:text-black rounded-xl shadow-md bodycopy">Cancel</a>
            <button type="submit"
              class="sko-btn py-5 px-10 bg-[#FFF3B2] hover:bg-black text-gray-800 hover:text-white rounded-xl shadow-md bodycopy">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
@endsection

@section('script')
<script>
  $('.formEdit').on('submit', function (event) {
    event.preventDefault();
    const form = this;
    const button = $(form).find('button[type="submit"]');

    Swal.fire({
      title: 'Simpan perubahan?',
      text: 'Pastikan data yang Anda masukkan sudah benar.',
      icon: 'question',
      showDenyButton: true,
      confirmButtonColor: '#00397C',
      denyButtonColor: '#7C0000',
      confirmButtonText: 'Ya, Simpan',
      denyButtonText: 'Batal',
    }).then((result) => {
      if (!result.isConfirmed) return;

      $('[data-error-for]').text('');
      $(form).find('.sko-input-error').removeClass('sko-input-error');
      button.prop('disabled', true);

      $.ajax({ url: form.action, method: 'POST', data: $(form).serialize() })
        .done(() => {
          Swal.fire({ icon: 'success', title: 'Profil berhasil diperbarui', timer: 1200, showConfirmButton: false })
            .then(() => { location.href = @json(route('profileView')); });
        })
        .fail((xhr) => {
          const errors = (xhr.responseJSON && xhr.responseJSON.errors) || {};
          Object.entries(errors).forEach(([field, messages]) => {
            $(`[data-error-for="${field}"]`).text(messages[0]);
            $(`#${field}`).addClass('sko-input-error');
          });
          SKO.toast('error', SKO.errorMessage(xhr));
        })
        .always(() => button.prop('disabled', false));
    });
  });
</script>
@endsection
