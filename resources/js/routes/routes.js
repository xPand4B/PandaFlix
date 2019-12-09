const routes = [
    {
        path: "/",
        component: () => import('../layouts/DefaultLayout'),
        children: [

            { path: "/", component: () => import('../pages/Homepage') }

        ]
    },

    { path: "*", component: () => import('../pages/Errors/404NotFound') }
];

export default routes;
