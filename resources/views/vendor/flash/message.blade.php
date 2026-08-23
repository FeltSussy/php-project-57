@foreach (session('flash_notification', collect()) as $message)
    <div @class([
        'mb-4 rounded-lg px-4 py-3',
        'bg-green-100 text-green-800' => $message['level'] === 'success',
        'bg-red-100 text-red-800' => $message['level'] === 'danger',
        'bg-yellow-100 text-yellow-800' => $message['level'] === 'warning',
        'bg-blue-100 text-blue-800' => $message['level'] === 'info',
    ])>
        {{ $message['message'] }}
    </div>
@endforeach
