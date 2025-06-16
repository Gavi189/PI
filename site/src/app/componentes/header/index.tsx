const Heather = () => {
    return (
        <header className="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white shadow-lg">
            <div className="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
                <div className="text-3xl font-black tracking-tight hover:scale-105 transition-transform duration-300 cursor-pointer">
                    Logo
                </div>
                <nav>
                    <ul className="flex space-x-8 text-lg font-semibold">
                        <li>
                            <a href="/." className="hover:text-indigo-400 transition-colors duration-200">Home</a>
                        </li>
                        <li>
                            <a href="/sobre" className="hover:text-indigo-400 transition-colors duration-200">Sobre</a>
                        </li>
                        <li>
                            <a href="/produtos" className="hover:text-indigo-400 transition-colors duration-200">Produtos</a>
                        </li>
                        <li>
                            <a href="/clientes" className="hover:text-indigo-400 transition-colors duration-200">Clientes</a>
                        </li>
                        <li>
                            <a href="/contato" className="hover:text-indigo-400 transition-colors duration-200">Contato</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>
    );
}

export default Heather;
