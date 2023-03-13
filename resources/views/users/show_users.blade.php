<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Listado de Usuarios') }}
        </h2>
    </x-slot>
    <div>
      <div class="flex justify-end">
        <a href="{{ route('create_user') }}"" class="m-4 rounded-md bg-green-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-green-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-600">+ Agregar Usuario</a>
      </div>
      <table class="table-auto shadow-lg mt-4 mx-auto bg-white">
        <thead>
          <tr>
            <th class="border text-center border-slate-500">Name</th>
            <th class="border text-center border-slate-500">Email</th>
            <th class="border text-center border-slate-500">Role</th>
            <th class="border text-center border-slate-500">User Since</th>
            <th class="border text-center border-slate-500"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
              <td class="border border-slate-500 p-2">{{ $user->name }}</td>
              <td class="border border-slate-500 p-2">{{ $user->email }}</td>
              <td class="border border-slate-500 p-2">{{ $user->role->description }}</td>
              <td class="border border-slate-500 p-2">{{ date('d/m/Y h:i', strtotime($user->created_at)) }}</td>
              <td class="border border-slate-500 p-2 flex">
                <a href="{{route('edit_user',['id'=>$user->id])}}" class="rounded-md bg-teal-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-teal-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-teal-600">Editar</a>
                
                <form method="POST" action="{{route('delete_user',['id'=>$user->id])}}">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}
          
                  <div class="form-group">
                      <input type="submit" class="rounded-md bg-rose-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-rose-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-600" value="Eliminar">
                  </div>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
</x-app-layout>