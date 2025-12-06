<aside class="sidebar {{ request()->is('admin/*') ? 'admin' : '' }}">
    <div class="logo">
        <a href="/" class="flex items-center gap-2 text-white">
            <div class="mark">SP</div>
            <div class="text-lg font-semibold">SPIL</div>
        </a>
    </div>
    <nav class="flex-1">
        <a href="{{ route('dashboard') }}" class="block py-2 px-2 rounded {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        <a href="{{ route('admin.letters') }}" class="block py-2 px-2 rounded {{ request()->routeIs('admin.letters*') ? 'active' : '' }}">Letters</a>
        <a href="{{ route('admin.reports') }}" class="block py-2 px-2 rounded {{ request()->routeIs('admin.reports*') ? 'active' : '' }}">Reports</a>
        <a href="{{ route('admin.rws.index') }}" class="block py-2 px-2 rounded {{ request()->routeIs('admin.rws*') ? 'active' : '' }}">RW</a>
        <a href="{{ route('admin.rts.index') }}" class="block py-2 px-2 rounded {{ request()->routeIs('admin.rts*') ? 'active' : '' }}">RT</a>
        <a href="{{ route('admin.residents.index') }}" class="block py-2 px-2 rounded {{ request()->routeIs('admin.residents*') ? 'active' : '' }}">Residents</a>
    </nav>
    <div class="mt-6">
        <a href="{{ route('dashboard') }}" class="block py-2 px-2 rounded text-xs text-white">View site</a>
    </div>
    <div class="mt-4">
        <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
        </form>

        <button id="logout-button" type="button" class="w-full text-left block py-2 px-2 rounded text-sm text-white hover:bg-white/5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline-block me-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1" />
            </svg>
            Keluar
        </button>

        <!-- Logout confirmation modal -->
        <div id="logout-modal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50" role="dialog" aria-modal="true" aria-labelledby="logout-modal-title">
            <div class="bg-white rounded-lg shadow-xl w-full sm:max-w-md p-6 mx-4 max-h-[80vh] overflow-auto relative">
                <button id="logout-close" type="button" class="absolute top-3 end-3 text-slate-400 hover:text-slate-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>

                <div class="flex items-center gap-3 mb-3">
                    <div class="bg-amber-100 rounded-full p-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                        </svg>
                    </div>
                    <h3 id="logout-modal-title" class="text-lg font-semibold">Konfirmasi Keluar</h3>
                </div>

                <p class="text-sm text-slate-700 mb-5">Anda yakin ingin keluar dari akun Anda sekarang? Semua sesi yang aktif akan berakhir dan Anda akan diarahkan ke halaman login.</p>

                <div class="flex justify-end gap-3">
                    <button id="logout-cancel" type="button" class="px-3 py-2 rounded bg-gray-100 text-slate-700">Batal</button>
                    <button id="logout-confirm" type="button" class="px-3 py-2 rounded bg-red-600 text-white inline-flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                        </svg>
                        Keluar
                    </button>
                </div>
            </div>
        </div>
        <script>
            (function(){
                const btn = document.getElementById('logout-button');
                const modal = document.getElementById('logout-modal');
                const cancel = document.getElementById('logout-cancel');
                const confirmBtn = document.getElementById('logout-confirm');
                const form = document.getElementById('logout-form');
                const closeBtn = document.getElementById('logout-close');

                if (!btn || !modal || !cancel || !confirmBtn || !form || !closeBtn) return;

                function openModal(){ modal.classList.remove('hidden'); modal.classList.add('flex'); document.body.style.overflow = 'hidden'; }
                function closeModal(){ modal.classList.add('hidden'); modal.classList.remove('flex'); document.body.style.overflow = ''; }

                btn.addEventListener('click', function(e){ openModal(); });
                cancel.addEventListener('click', function(){ closeModal(); });
                closeBtn.addEventListener('click', function(){ closeModal(); });

                // close on backdrop click
                modal.addEventListener('click', function(e){ if (e.target === modal) closeModal(); });

                // ESC to close
                document.addEventListener('keydown', function(e){ if (e.key === 'Escape') closeModal(); });

                confirmBtn.addEventListener('click', function(){ form.submit(); });
            })();
        </script>
    </div>
</aside>
