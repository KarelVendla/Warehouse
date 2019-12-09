import Warehouses from "./components/Warehouses";
import Details from "./components/Detailswarehouse";
import Coordinates from "./components/ManagerCoordinates";
import Rooms from "./components/Rooms";

export default {
    
    mode: "history",

    routes: [
        {
            path: '/',
            components: {
                default: Warehouses,
                coordinates: Coordinates
            }
            
        },
        {
            path: '/details/:warehouseID',
            name: 'Details',
            component: {
                default: Details,
                rooms: Rooms
            }
        }
    ]
};
