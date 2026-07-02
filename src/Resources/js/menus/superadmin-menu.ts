import { Shield } from 'lucide-react';

declare global {
    function route(name: string): string;
}

export const examplepackageSuperAdminMenu = (t: (key: string) => string) => ({
    title: t('ExamplePackage Dashboard'),
    href: route('example-package.index'),
    permission: 'manage-example-package',
    parent: 'dashboard',
    order: 10,
});
