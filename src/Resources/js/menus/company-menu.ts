import { Package } from 'lucide-react';

declare global {
    function route(name: string): string;
}

export const examplepackageCompanyMenu = (t: (key: string) => string) => [
    {
        title: t('ExamplePackage Dashboard'),
        href: route('example-package.index'),
        permission: 'manage-example-package',
        parent: 'dashboard',
        order: 10,
    },
    {
        title: t('ExamplePackage'),
        icon: Package,
        permission: 'manage-example-package',
        order: 10,
        children: [
            {
                title: t('Items'),
                href: route('example-package.items.index'),
                permission: 'manage-example-package',
            },
        ],
    },
];