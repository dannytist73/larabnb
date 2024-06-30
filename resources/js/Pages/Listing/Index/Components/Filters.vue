<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";

const brands = ref([
    "Honda",
    "KTM",
    "Kawasaki",
    "Yamaha",
    "Harley-Davidson",
    "BMW",
]);

const engine = ref(["125cc", "200cc", "500cc", "750cc", "1000cc", "1290cc"]);

const props = defineProps({ filters: Object });

const filterForm = useForm({
    priceFrom: props.filters.priceFrom ?? null,
    priceTo: props.filters.priceTo ?? null,
    brand: props.filters.brand ?? null,
    engine: props.filters.engine ?? null,
    mileage: props.filters.mileage ?? null,
    location: props.filters.location ?? null,
});

const filter = () => {
    filterForm.get(route("listing.index"), {
        preserveState: true,
        preserveScroll: true,
    });
};

const clear = () => {
    filterForm.priceFrom = null;
    filterForm.priceTo = null;
    filterForm.brand = null;
    filterForm.engine = null;
    filterForm.mileage = null;
    filterForm.location = null;
    filter();
};
</script>

<template>
    <form @submit.prevent="filter">
        <div class="mb-8 mt-4 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center">
                <input
                    type="text"
                    placeholder="Price from"
                    class="input-filter-l w-28"
                    v-model.number="filterForm.priceFrom"
                />
                <input
                    type="text"
                    placeholder="Price to"
                    class="input-filter-r w-28"
                    v-model.number="filterForm.priceTo"
                />
            </div>
            <div class="flex flex-nowrap items-center">
                <select class="input-filter-l" v-model="filterForm.brand">
                    <option :value="null" disabled>-- Select a brand --</option>
                    <option v-for="n in brands" :key="n" :value="n">
                        {{ n }}
                    </option>
                </select>
                <select class="input-filter-r" v-model="filterForm.engine">
                    <option :value="null" disabled>
                        -- Select engine size --
                    </option>
                    <option v-for="n in engine" :key="n" :value="n">
                        {{ n }}
                    </option>
                </select>
            </div>
            <div class="flex flex-nowrap items-center">
                <input
                    type="text"
                    placeholder="Mileage"
                    class="input-filter-l w-28"
                    v-model.number="filterForm.mileage"
                />
                <input
                    type="text"
                    placeholder="Location"
                    class="input-filter-r w-28"
                    v-model="filterForm.location"
                />
            </div>

            <button type="submit" class="btn-edit">Filter</button>
            <button type="reset" class="btn-link" @click="clear">Clear</button>
        </div>
    </form>
</template>
