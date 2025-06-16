export function Footer() {
  return (
    <footer className="bg-gray-800 text-white p-4 text-center">
      <p>
        &copy; {new Date().getFullYear()} Meu Site. Todos os direitos reservados.
      </p>
      <p>
        Desenvolvido por <strong>Glauco Luiz</strong>
      </p>
    </footer>
  );
}
