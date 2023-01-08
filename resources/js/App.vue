<script setup>
import { ref } from "vue";
import axios from "axios";
const props = defineProps({
    endpoint: String,
});
const pdfs = ref([
    {
        name: "hello-world.pdf",
    },
    {
        name: "hello-world-2.pdf",
    },

    {
        name: "hello-world-3.pdf",
    },
]);
const tempPdf = ref([]);
const showPdf = ref(false);
function submitHandler(e) {
    if (tempPdf.value.length === 0) {
        alert("Please Add File");
        return;
    }
    axios
        .post(props.endpoint, {
            allFilename: tempPdf.value,
        })
        .then((e) => {
            showPdf.value = true;
            tempPdf.value = [];
        })
        .catch((e) => {
            console.log(e);
            tempPdf.value = [];
        });
}
</script>
<template>
    <div
        class="flex items-center justify-content-center flex-column min-h-screen"
    >
        <form @submit.prevent="submitHandler" v-if="!showPdf">
            <div class="flex flex-row">
                <div v-for="item in pdfs">
                    <input
                        type="checkbox"
                        :value="item.name"
                        v-model="tempPdf"
                    />

                    <label>{{ item.name }}</label>
                </div>
            </div>
            <button type="submit">Submit</button>
        </form>
        <div v-else>
            <a href="/merged_result.pdf" download style="margin-right: 10px"
                >Download</a
            >
            <button @click="showPdf = false">Back</button>
        </div>
    </div>
</template>

<style>
.flex {
    display: flex;
}
.flex-row {
    flex-direction: row;
}

.flex-column {
    flex-direction: column;
}
.items-center {
    align-items: center;
}
.justify-content-center {
    justify-content: center;
}
.min-h-screen {
    min-height: 100vh;
}
</style>
