hoa mundo
<div>
    <div class="block col-md-6">
       <div class="block-header block-header-default">
           <h4 class="block-title">Lista de jugadores</h4>
       </div>
       <div class="block-content">
        <table class="table table-striped table-vcenter">
            <thead>
                <tr>
                    <th class="text-center" style="width: 100px;">
                        Id
                    </th>
                    <th class="text-center" style="width: 100px;">
                        Apodo de juego
                    </th>
                  
                    <th class="text-center" style="width: 100px;">
                        Ping
                    </th>
                </tr>
            </thead>
    
            <tbody>
            @foreach($arrayPlayers as $currentPlayer)
                    <tr>
                        <td class="text-center">{{ $currentPlayer['playerid'] }}</td>
                        <td class="text-center">{{ $currentPlayer['nickname'] }}</td>
                        {{-- <td class="text-center">{{ $currentPlayer['addr'] }}</td> --}}
                        
                        <td class="text-center">{{ $currentPlayer['ping'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
       </div>
    </div>
</div>
