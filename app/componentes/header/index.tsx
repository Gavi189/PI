export function Header() {
    return (
        <header className="flex items-center justify-between p-4 bg-gray-800 text-white">
            <div className="text-lg font-bold">Logo</div>
            <nav>
                <ul className="flex space-x-4">
                    <li><a href="/" className="hover:underline">Home</a></li>
                    <li><a href="/sobre" className="hover:underline">Sobre</a></li>
                    <li><a href="/produtos" className="hover:underline">Produtos</a></li>
                    <li><a href="/clientes" className="hover:underline">Clientes</a></li>
                    <li><a href="/contato" className="hover:underline">Contato</a></li>
                </ul>
            </nav>
        </header>
    );
}