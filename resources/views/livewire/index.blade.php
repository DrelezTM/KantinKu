<div>
    <livewire:components.navbar />
    
    <main class="min-h-screen">
        <!-- Background cover untuk seluruh main content -->
        <div class="bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('images/bg.png') }}')">
            <livewire:components.jumbotron />
            <livewire:components.about />
            
            <!-- Featured Products Section -->
            <livewire:components.list-product 
                title="Menu Unggulan" 
                :limit="8"
                :showViewAll="true"
            />
            
            <!-- Popular Products Section -->
            <livewire:components.list-product 
                title="Paling Populer" 
                :limit="4"
                :showViewAll="false"
            />

            <!-- Feedback Section -->
            <livewire:components.feedback
                title="Ajukan Aduan" 
            />
            
        </div>
    </main>
    
    <livewire:components.footer />
    
    <!-- PRODUCT DETAIL COMPONENT DITARUH DI ROOT ↓ -->
    <livewire:components.detail-product />
</div>