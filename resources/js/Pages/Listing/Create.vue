<script setup lang="ts">
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    year: 0,
    price: 0,
    mileage: 0,
    name: "",
    brand: "",
    engine_size: "",
    color: "",
    location: "",
    seller_contact: "",
});

const create = () => form.post(route("listing.store"));
</script>

<template>
    <form @submit.prevent="create">
        <div class="grid grid-cols-6 gap-4">
            <div class="col-span-2">
                <label class="label">Year Model</label>
                <input type="number" v-model="form.year" class="input" />
                <div v-if="form.errors.year" class="input-error">
                    {{ form.errors.year }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Mileage</label>
                <input type="number" v-model="form.mileage" class="input" />
                <div v-if="form.errors.mileage" class="input-error">
                    {{ form.errors.mileage }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Brand</label>
                <input type="text" v-model="form.brand" class="input" />
                <div v-if="form.errors.brand" class="input-error">
                    {{ form.errors.brand }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Motorcycle name</label>
                <input type="text" v-model="form.name" class="input" />
                <div v-if="form.errors.name" class="input-error">
                    {{ form.errors.name }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Engine Size</label>
                <input type="text" v-model="form.engine_size" class="input" />
                <div v-if="form.errors.engine_size" class="input-error">
                    {{ form.errors.engine_size }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Color</label>
                <input type="text" v-model="form.color" class="input" />
                <div v-if="form.errors.color" class="input-error">
                    {{ form.errors.color }}
                </div>
            </div>

            <div class="col-span-4">
                <label class="label">Location</label>
                <input type="text" v-model="form.location" class="input" />
                <div v-if="form.errors.location" class="input-error">
                    {{ form.errors.location }}
                </div>
            </div>

            <div class="col-span-2">
                <label class="label">Seller Contact</label>
                <input
                    type="text"
                    v-model="form.seller_contact"
                    class="input"
                />
                <div v-if="form.errors.seller_contact" class="input-error">
                    {{ form.errors.seller_contact }}
                </div>
            </div>

            <div class="col-span-6">
                <label class="label">Price</label>
                <input type="number" v-model="form.price" class="input" />
                <div v-if="form.errors.price" class="input-error">
                    {{ form.errors.price }}
                </div>
            </div>

            <div>
                <button type="submit" class="btn-primary">Create</button>
            </div>
        </div>
    </form>
</template>
