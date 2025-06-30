const Footer = () => {
    return (
        <footer className="bg-gray-900 text-white py-6 mt-10 shadow-inner">
            <div className="max-w-7xl mx-auto px-6 text-center">
                <p className="text-sm md:text-base">
                    &copy; {new Date().getFullYear()} <span className="font-semibold">Sua Empresa</span>. Todos os direitos reservados.
                </p>
                <p className="text-xs md:text-sm mt-2">
                    Desenvolvido por <a href="./" className="text-indigo-400 hover:text-indigo-300 transition-colors duration-200 underline underline-offset-2">Glauco Luiz</a>
                </p>
            </div>
        </footer>
    );
}

export default Footer;
