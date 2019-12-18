<template>
    <div class="container">
        <h1 >Warehouse</h1>
        <form method="GET">
    
            <table class="table-borderless col mx-md-auto">
                <tr>
                    <td>Name</td>
                </tr>
                <tr>
                    <td>
    
                        <input v-model="warehouseData.name" type="text" class="form-control" placeholder="Name" />
                    </td>
                </tr>
                <tr>
                    <td>Longitude</td>
                </tr>
                <tr>
                    <td>
                        <input v-model.number="warehouseData.longitude" type="number" step="any" class="form-control" placeholder="Longitude" />
                    </td>
                </tr>
                <tr>
                    <td>Latitude</td>
                </tr>
                <tr>
                    <td>
                        <input v-model.number="warehouseData.latitude" type="number" step="any" class="form-control" placeholder="Latitude" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        warehouseData: {
            type: Object
        }
    }
}
</script>
