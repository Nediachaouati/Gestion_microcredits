<nav class="navbar navbar-light navbar-top navbar-expand">
    <div class="navbar-logo"><button class="btn navbar-toggler navbar-toggler-humburger-icon" type="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalCollapse" aria-controls="navbarVerticalCollapse" aria-expanded="false" aria-label="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button> <a class="navbar-brand me-1 me-sm-3" href="/admin/dashboard">
        <div class="d-flex align-items-center">
          <div class="d-flex align-items-center"><img src="{{asset('dashassets/img/icons/logoMicro.png')}}" alt="phoenix" width="32">
            <p class="logo-text ms-2 d-none d-sm-block">Tamouilek</p>
          </div>
        </div>
      </a></div>
    <div class="collapse navbar-collapse">
      
   
      <ul class="navbar-nav navbar-nav-icons ms-auto flex-row">
        <li class="nav-item dropdown" style="position: relative;">
            <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
               style="text-decoration: none; color: #000; display: inline-flex; align-items: center;" onclick="toggleNotificationMenu(event)">
             
                <span id="notification-count" class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-circle"
                     style="font-size: 10px; padding: 5px 8px;">
                    {{ $unreadCount }} <!-- Affiche le nombre de notifications non lues -->
                </span>
      
                <span class="text-700" data-feather="bell" style="height: 20px; width: 20px; color: #007bff;"></span>
            </a>
    
            
            <div class="dropdown-menu dropdown-menu-end p-0 shadow" style="width: 320px; border-radius: 5px; overflow: hidden; position: absolute; top: 100%; right: 0; z-index: 1050;" id="notification-menu">
                <div class="card" style="border: none;">
                   
                    <div class="card-header bg-light text-center py-2" style="background-color: #f8f9fa; font-weight: bold;font-size: 14px;">
                        Notifications
                    </div>
                   
                    <div class="card-body p-0" style="max-height: 300px; overflow-y: auto;">
                       
                        <ul class="list-group list-group-flush">
                            @forelse($notifications->reverse() as $notification)
                            <li class="list-group-item d-flex align-items-start"
                                style="display: flex; align-items: flex-start; padding: 10px; background-color: {{ $notification->read ? '#ffffff' : '#f0f8ff' }};">
                                <span class="me-3 text-warning" style="color: #ffc107; font-size: 16px;">
                                    <i class="fas fa-bell"></i>
                                </span>
                                <div style="flex-grow: 1;">
                                   <span class="fw-bold" style="font-weight: bold; font-size: 14px;">
                                        {{ $notification->message }}
                                   </span>
                                    <br>
                                  <small class="text-muted" style="color: #6c757d; font-size: 12px;">
                                      {{ $notification->created_at->diffForHumans() }}
                                  </small>
                                 </div>
    
                                <button class="btn btn-link text-primary ms-auto" style="cursor: pointer; padding: 0;" onclick="toggleDropdownMenu(this)">
                                    &#9660; 
                                </button>
    
                                <div class="dropdown-options" style="display: none; padding: 10px; background-color: #fff; width: 100%;">
                                    <!-- Marquer comme lue/non lue -->
                                    <form action="{{ route('notification.Read', $notification->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-primary w-100">
                                            {{ $notification->read ? 'Marquer comme non lue' : 'Marquer comme lue' }}
                                        </button>
                                    </form>
                                
                                    <form action="{{ route('notification.delete', $notification->id) }}" method="POST" style="margin: 0;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">Supprimer</button>
                                    </form>
    
                                </div>
                            </li>
                            @empty
                                <li class="list-group-item text-center text-muted py-3"
                                    style="font-size: 14px; color: #6c757d; padding: 20px;">
                                    Aucune notification.
                                </li>
                            @endforelse
                        </ul>
                    </div>
                
                    <div class="card-footer bg-light text-center py-2"
                         style="background-color: #f8f9fa; font-size: 12px;">
                        <a href="#" class="small text-muted" style="text-decoration: none; color: #007bff; font-size: 14px;">
                            Voir toutes les notifications
                        </a>
                    </div>
                </div>
            </div>
        </li>

    
        <script>
          // Fonction pour afficher/masquer le menu déroulant des options de notification
          function toggleDropdownMenu(button) {
              const dropdownMenu = button.nextElementSibling;
              dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
          }
      
          // Fonction pour gérer l'affichage du menu de notification
          function toggleNotificationMenu(event) {
              const notificationMenu = document.getElementById('notification-menu');
              notificationMenu.style.display = notificationMenu.style.display === 'block' ? 'none' : 'block';
              event.stopPropagation(); // Empêche le menu de se fermer immédiatement après avoir cliqué sur l'icône
          }
      
          // Ferme le menu si on clique en dehors de celui-ci
          document.addEventListener('click', function(event) {
              const notificationMenu = document.getElementById('notification-menu');
              if (!notificationMenu.contains(event.target) && event.target !== notificationMenu) {
                  notificationMenu.style.display = 'none';
              }
          });
      </script>
      
    
    
    
    
    
    
    

      
      
        <li class="nav-item dropdown"><a class="nav-link notification-indicator notification-indicator-primary" id="navbarDropdownSettings" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="text-700" data-feather="settings" style="height:20px;width:20px;"></span></a></li>

    
    
    
    
    

      
        <li class="nav-item dropdown"><a class="nav-link" id="navbarDropdownNindeDots" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><svg width="16" height="16" viewbox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="2" cy="2" r="2" fill="#6C6E71"></circle>
              <circle cx="2" cy="8" r="2" fill="#6C6E71"></circle>
              <circle cx="2" cy="14" r="2" fill="#6C6E71"></circle>
              <circle cx="8" cy="8" r="2" fill="#6C6E71"></circle>
              <circle cx="8" cy="14" r="2" fill="#6C6E71"></circle>
              <circle cx="14" cy="8" r="2" fill="#6C6E71"></circle>
              <circle cx="14" cy="14" r="2" fill="#6C6E71"></circle>
              <circle cx="8" cy="2" r="2" fill="#6C6E71"></circle>
              <circle cx="14" cy="2" r="2" fill="#6C6E71"></circle>
            </svg></a>
          <div class="dropdown-menu dropdown-menu-end py-0 dropdown-nide-dots shadow border border-300" aria-labelledby="navbarDropdownNindeDots">
            <div class="card bg-white position-relative border-0">
              <div class="card-body pt-3 px-3 pb-0 overflow-auto scrollbar" style="height: 20rem;">
                <div class="row text-center align-items-center gx-0 gy-0">
                  <div class="col-4"><a class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3" href="#!" target="_blank"><img src="assets/img/nav-icons/behance.png" alt="" width="30">
                      <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Behance</p>
                    </a></div>
                  <div class="col-4"><a class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3" href="#!" target="_blank"><img src="assets/img/nav-icons/google-cloud.png" alt="" width="30">
                      <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Cloud</p>
                    </a></div>
                  <div class="col-4"><a class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3" href="#!" target="_blank"><img src="assets/img/nav-icons/slack.png" alt="" width="30">
                      <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Slack</p>
                    </a></div>
                  <div class="col-4"><a class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3" href="#!" target="_blank"><img src="assets/img/nav-icons/github.png" alt="" width="30">
                      <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Github</p>
                    </a></div>
                  <div class="col-4"><a class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3" href="#!" target="_blank"><img src="assets/img/nav-icons/bitbucket.png" alt="" width="30">
                      <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">BitBucket</p>
                    </a></div>
                  <div class="col-4"><a class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3" href="#!" target="_blank"><img src="assets/img/nav-icons/google-drive.png" alt="" width="30">
                      <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Drive</p>
                    </a></div>
                  <div class="col-4"><a class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3" href="#!" target="_blank"><img src="assets/img/nav-icons/trello.png" alt="" width="30">
                      <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Trello</p>
                    </a></div>
                  <div class="col-4"><a class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3" href="#!" target="_blank"><img src="assets/img/nav-icons/figma.png" alt="" width="20">
                      <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Figma</p>
                    </a></div>
                  <div class="col-4"><a class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3" href="#!" target="_blank"><img src="assets/img/nav-icons/twitter.png" alt="" width="30">
                      <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Twitter</p>
                    </a></div>
                  <div class="col-4"><a class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3" href="#!" target="_blank"><img src="assets/img/nav-icons/pinterest.png" alt="" width="30">
                      <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Pinterest</p>
                    </a></div>
                  <div class="col-4"><a class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3" href="#!" target="_blank"><img src="assets/img/nav-icons/linkedin.png" alt="" width="30">
                      <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Linkedin</p>
                    </a></div>
                  <div class="col-4"><a class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3" href="#!" target="_blank"><img src="assets/img/nav-icons/google-maps.png" alt="" width="30">
                      <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Maps</p>
                    </a></div>
                  <div class="col-4"><a class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3" href="#!" target="_blank"><img src="assets/img/nav-icons/google-photos.png" alt="" width="30">
                      <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Photos</p>
                    </a></div>
                  <div class="col-4"><a class="d-block hover-bg-200 p-2 rounded-3 text-center text-decoration-none mb-3" href="#!" target="_blank"><img src="assets/img/nav-icons/spotify.png" alt="" width="30">
                      <p class="mb-0 text-black text-truncate fs--2 mt-1 pt-1">Spotify</p>
                    </a></div>
                </div>
              </div>
            </div>
          </div>
        </li>
        <li class="nav-item dropdown"><a class="nav-link lh-1 px-0 ms-5" id="navbarDropdownUser" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <div class="avatar avatar-l"><img class="rounded-circle" src="{{ auth()->user()->profile_image ? asset(auth()->user()->profile_image) : asset('path/to/default/avatar.png') }}" alt="User's Photo"></div>
        </a>
        <div class="dropdown-menu dropdown-menu-end py-0 dropdown-profile shadow border border-300" aria-labelledby="navbarDropdownUser">
          <div class="card bg-white position-relative border-0">
            <div class="card-body p-0 overflow-auto scrollbar" style="height: 18rem;">
              <div class="text-center pt-4 pb-3">
                <div class="avatar avatar-xl"><img class="rounded-circle" src="{{ auth()->user()->profile_image ? asset(auth()->user()->profile_image) : asset('path/to/default/avatar.png') }}" alt="User's Photo"></div>
                <h6 class="mt-2">{{ auth()->user()->name }}</h6>
                </div>
                <hr/>
                <ul class="nav d-flex flex-column mb-2 pb-1">
                  <li class="nav-item"><a class="nav-link px-3" href="/admin/profile"><span class="me-2 text-900" data-feather="user"></span>Profil</a></li>
                  <li class="nav-item"><a class="nav-link px-3" href="#!"><span class="me-2 text-900" data-feather="pie-chart"></span>Dashboard</a></li>
                  <li class="nav-item"><a class="nav-link px-3" href="#!"><span class="me-2 text-900" data-feather="lock"></span>Posts </a></li>
                  <li class="nav-item"><a class="nav-link px-3" href="#!"><span class="me-2 text-900" data-feather="settings"></span>Paramétre </a></li>
                
                  <li class="nav-item"><a class="nav-link px-3" href="#!"><span class="me-2 text-900" data-feather="globe"></span>Language</a></li>
                </ul>
              </div>
              <div class="card-footer p-0 border-top">
                <ul class="nav d-flex flex-column my-3">
                  <li class="nav-item"><a class="nav-link px-3" href="#!"><span class="me-2 text-900" data-feather="user-plus"></span>Ajouter un autre compte</a></li>
                </ul>
                <hr>
                <div class="px-3">
                    <a onclick=" event.preventDefault();
                       document.getElementById('logout-form').submit();"
                       class="btn btn-phoenix-secondary d-flex flex-center w-100" 
                       href="#!">
                        <span class="me-2" data-feather="log-out"></span>Déconnexion</a>
                        <form id="logout-form" action="{{route('logout')}}" method="POST"
                        class="d-none">
                        @csrf
                        </form>
                    </div>
                <br>
            </div>
          </div>
        </li>
      </ul>
    </div>
  </nav>