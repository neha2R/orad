

<div class="container mx-auto">
    <form method="POST"  wire:submit.prevent="store">
        <input type="file" wire:model="importfile"  /> 
        <button type="submit">Submit</button>
    </form>
    <div wire:loading>
        Processing Payment...
    </div>
</div>
