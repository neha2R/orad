<div class="flex justify-between items-center mt-3">
    <div >
        <label for="" class="block font-light ">Show Entries :</label>
        <select wire:model="paginate" id="paginate"
            class=" appearance-none form-input w-12">
            <option value="">--Select--</option>
            @foreach (pages() as $item)
                <option value="{{ $item }}"> {{ $item  }}</option>
            @endforeach
        </select>
    </div>
    <div class="">
        <label for="" class="block font-light ">Search :</label>
        <input type="text" placeholder="Search" wire:model.debounce.500ms="search" class="form-input">
    </div>
</div>
