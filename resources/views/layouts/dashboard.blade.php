<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title></title>
    {{--
    <link href="{{ asset('js/sidebars.js') }}" rel="stylesheet"> --}}
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <!-- Custom styles for this template -->
    <link href="{{ asset('css/sidebars.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css">

  
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>


</head>

<body>
    <main class="d-flex flex-nowrap">
        <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 280px;">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <svg class="bi pe-none me-2" width="40" height="32">
                    <use xlink:href="#bootstrap" />
                </svg>
                <span class="fs-4">Perusahaan X</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">

                <li>
                    <a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : 'text-white' }}" >
                        Dashboard
                    </a>
                </li>
                {{-- Manajer Dan Superviser--}}
                @if (Auth::user()->role == 1  || Auth::user()->role == 2)
                <li>
                    <a href="{{ url('persetujuan') }}" class="nav-link {{ Request::is('persetujuan') ? 'active' : 'text-white' }}" >
                        Persetujuan Penyewaan
                    </a>
                </li>
                @endif
                
                {{-- Hanya Admin  --}}
                @if (Auth::user()->role == 0)
                <li>
                    <a href="{{ url('kendaraan') }}" class="nav-link {{ Request::is('kendaraan') ? 'active' : 'text-white' }}">
                        Daftar Kendaraan
                    </a>
                </li>
                <li>
                    <a href="{{ url('driver') }}" class="nav-link {{ Request::is('driver') ? 'active' : 'text-white' }}">
                        Daftar Driver
                    </a>
                </li>
                <li>
                    <a href="{{ url('penyewaan') }}" class="nav-link {{ Request::is('penyewaan') ? 'active' : 'text-white' }}">
                        Daftar Penyewaan
                    </a>
                </li>
                @endif
                
            
            </ul>
            <hr>
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
                    <strong>{{ Auth::user()->username}}</strong>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                         {{ __('Logout') }}
                     </a>
    
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                         @csrf
                     </form>
                    </li>
                    
                </ul>
            </div>
        </div>
        @if (Request::is('/') || Request::is('home'))
        <div class="container-fluid p-3">
            <h2>Hallo , {{ Auth::user()->name }}</h2>
            <h4>Anda Login Sebagai 
                @if (Auth::user()->role == 0)
                Admin
                @elseif(Auth::user()->role == 1)  
                Supervisor Region
                @else
                Manajer
                @endif
        
            </h4>
            <div>
                <canvas id="myChart"></canvas>
            </div>
              
        </div>
        @else
        <div class="container-fluid p-3">
            @if (session('status'))
				<div class="alert alert-success">
					{{ session('status') }}
				</div>
			@endif
            @yield('content')
        </div>
        @endif
        
    </main>
    

    @yield('js')
    @if (Request::is('/') || Request::is('home'))
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
      
        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: [
                @foreach($pemakaians as $item)
                '{{ $item->nama_kendaraan }}',
                @endforeach
            ],
            datasets: [{
              label: 'Jumlah Penyewaan Atau Pemakaian',
              data: [
                @foreach($pemakaians as $item)
                {{ $item->pemakaian }},
                @endforeach
              ],
              borderWidth: 1
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      </script>
    @endif
</body>

</html>